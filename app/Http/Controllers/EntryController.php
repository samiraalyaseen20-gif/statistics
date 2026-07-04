<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\EyeTest;
use App\Models\LabTest;
use App\Models\Surgery;
use App\Models\Doctor;
use App\Models\ClinicUnit;
use App\Models\Governorate;
use App\Models\Country;
use App\Models\TestType;
use App\Models\LabTestType;
use App\Models\OperationName;
use App\Models\Sector;
use App\Models\DoctorOperationStat;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{
    private function checkPermission() {
        $user = Auth::user();
        if ($user->role !== 'admin' && !$user->can_enter_data) {
            abort(response()->json(['error' => 'غير مصرح لك بإدخال أو حذف البيانات الإحصائية'], 403));
        }
    }

    public function clearData(Request $r)
    {
        $this->checkPermission();
        $r->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date',
            'type'       => 'required|in:visits_doctors,visits_govs,visits_countries,surgeries_cls,surgeries_ops,surgeries_docs,eye_tests,lab_tests,surgeries_govs,surgeries_countries'
        ]);

        $start = $r->start_date;
        $end = $r->end_date;
        if (strlen($start) === 7) $start = $start . '-01';
        if (strlen($end) === 7) $end = \Carbon\Carbon::parse($end)->endOfMonth()->toDateString();

        switch ($r->type) {
            case 'visits_doctors':
                $defaultDoc = Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
                $defaultUnit = ClinicUnit::first();
                if ($defaultDoc && $defaultUnit) {
                    Visit::whereBetween('visit_date', [$start, $end])
                        ->whereNull('governorate_id')
                        ->whereNull('country_id')
                        ->whereNotIn('patient_name', ['قيد إحصائي فحص', 'قيد إحصائي تحليل'])
                        ->where(function($query) use ($defaultDoc, $defaultUnit) {
                            $query->where(function($sub1) {
                                $sub1->whereNull('governorate_id')
                                     ->whereNull('country_id')
                                     ->whereDoesntHave('eyeTests')
                                     ->whereDoesntHave('labTests');
                            })
                            ->orWhere(function($sub2) use ($defaultDoc, $defaultUnit) {
                                $sub2->where('doctor_id', '!=', $defaultDoc->id)
                                     ->orWhere('clinic_unit_id', '!=', $defaultUnit->id);
                            });
                        })
                        ->delete();
                }
                break;
            case 'visits_govs':
                Visit::whereBetween('visit_date', [$start, $end])
                    ->whereNotNull('governorate_id')
                    ->delete();
                break;
            case 'visits_countries':
                Visit::whereBetween('visit_date', [$start, $end])
                    ->whereNotNull('country_id')
                    ->delete();
                break;
            case 'surgeries_ops':
                $defaultDoc = Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
                $defaultOp = OperationName::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
                if ($defaultDoc && $defaultOp) {
                    Surgery::whereBetween('op_date', [$start, $end])
                        ->whereNull('governorate_id')
                        ->whereNull('country_id')
                        // استبعاد سجلات التصنيفات (cls) التي لها sector_id و classification
                        ->where(function($q) {
                            $q->whereNull('sector_id')->orWhereNull('classification');
                        })
                        ->where(function($query) use ($defaultDoc, $defaultOp) {
                            $query->where('doctor_id', $defaultDoc->id)
                                  ->orWhere(function($sub) use ($defaultDoc, $defaultOp) {
                                      $sub->where('doctor_id', '!=', $defaultDoc->id)
                                          ->where('operation_name_id', '!=', $defaultOp->id);
                                  });
                        })
                        ->delete();
                }
                break;
            case 'surgeries_docs':
                $defaultDoc = Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
                $defaultOp = OperationName::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
                if ($defaultDoc && $defaultOp) {
                    $query = Surgery::whereBetween('op_date', [$start, $end])
                        ->whereNull('governorate_id')
                        ->whereNull('country_id')
                        ->whereNotNull('classification');
                    
                    if ($r->has('sector_id')) {
                        $query->where('sector_id', $r->sector_id);
                    }
                    $query->delete();
                }
                break;
            case 'surgeries_cls':
                // Delete classification×sector entries saved with defaultDoc + defaultOp
                $defaultDoc = Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
                $defaultOp  = OperationName::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
                if ($defaultDoc && $defaultOp) {
                    Surgery::whereBetween('op_date', [$start, $end])
                        ->whereNull('governorate_id')
                        ->whereNull('country_id')
                        ->where('doctor_id', $defaultDoc->id)
                        ->where('operation_name_id', $defaultOp->id)
                        ->whereNotNull('sector_id')
                        ->whereNotNull('classification')
                        ->delete();
                }
                break;
            case 'surgeries_govs':
                $defaultDoc = Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
                $defaultOp  = OperationName::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
                if ($defaultDoc && $defaultOp) {
                    Surgery::whereBetween('op_date', [$start, $end])
                        ->where('doctor_id', $defaultDoc->id)
                        ->where('operation_name_id', $defaultOp->id)
                        ->whereNotNull('governorate_id')
                        ->delete();
                }
                break;
            case 'surgeries_countries':
                $defaultDoc = Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
                $defaultOp  = OperationName::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
                if ($defaultDoc && $defaultOp) {
                    Surgery::whereBetween('op_date', [$start, $end])
                        ->where('doctor_id', $defaultDoc->id)
                        ->where('operation_name_id', $defaultOp->id)
                        ->whereNotNull('country_id')
                        ->delete();
                }
                break;
            case 'eye_tests':
                $eyeTests = EyeTest::whereBetween('test_date', [$start, $end])->get();
                foreach ($eyeTests as $et) {
                    $visit = $et->visit;
                    $et->delete();
                    if ($visit) $visit->delete();
                }
                break;
            case 'lab_tests':
                $labTests = LabTest::whereBetween('test_date', [$start, $end])->get();
                foreach ($labTests as $lt) {
                    $visit = $lt->visit;
                    $lt->delete();
                    if ($visit) $visit->delete();
                }
                break;
        }

        return response()->json(['ok' => true]);
    }

    // ========== VISITS ==========
    public function visitsIndex(Request $r)
    {
        $defaultDoc = Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
        $defaultUnit = ClinicUnit::first();

        $editedMonths = Visit::where('patient_name', 'قيد إحصائي')
            ->selectRaw("DISTINCT DATE_FORMAT(visit_date, '%Y-%m') as month")
            ->pluck('month')
            ->toArray();

        $q = Visit::with(['doctor','clinicUnit','governorate','country'])
            ->whereNotIn('patient_name', ['قيد إحصائي فحص', 'قيد إحصائي تحليل']);

        if (!empty($editedMonths)) {
            $q->where(function($query) use ($editedMonths) {
                $query->where('patient_name', '!=', 'مريض مجهول')
                      ->orWhereNotIn(\Illuminate\Support\Facades\DB::raw("DATE_FORMAT(visit_date, '%Y-%m')"), $editedMonths);
            });
        }

        $q->when($r->start_date && $r->end_date, function($q) use ($r) {
                $start = $r->start_date;
                $end = $r->end_date;
                if (strlen($start) === 7) $start = $start . '-01';
                if (strlen($end) === 7) $end = \Carbon\Carbon::parse($end)->endOfMonth()->toDateString();
                $q->whereBetween('visit_date', [$start, $end]);
            })
            ->when($r->type === 'visits_doctors', function($q) {
                $q->whereNull('governorate_id')
                  ->whereNull('country_id')
                  ->whereDoesntHave('eyeTests')
                  ->whereDoesntHave('labTests');
            })
            ->when($r->type === 'visits_govs', fn($q) => $q->whereNotNull('governorate_id'))
            ->when($r->type === 'visits_countries', fn($q) => $q->whereNotNull('country_id'))
            ->latest('id');

        if ($r->get('per_page') == 1000) {
            return response()->json(['data' => $q->get()]);
        }

        return response()->json($q->paginate($r->get('per_page', 20)));
    }

    public function visitsStore(Request $r)
    {
        $this->checkPermission();
        $r->validate([
            'patient_name'   => 'nullable|string|max:255',
            'doctor_id'      => 'required|exists:doctors,id',
            'clinic_unit_id' => 'required|exists:clinic_units,id',
            'governorate_id' => 'nullable|exists:governorates,id',
            'country_id'     => 'nullable|exists:countries,id',
            'status'         => 'nullable|in:مدفوع,غير مدفوع',
            'visit_date'     => 'required|date',
            'quantity'       => 'nullable|integer|min:1'
        ]);

        $qty = $r->get('quantity', 1);
        $patientName = $r->get('patient_name') ?: 'قيد إحصائي';
        
        $lastVisit = null;
        for ($i = 0; $i < $qty; $i++) {
            $lastVisit = Visit::create([
                'patient_name'   => $patientName,
                'doctor_id'      => $r->doctor_id,
                'clinic_unit_id' => $r->clinic_unit_id,
                'governorate_id' => $r->governorate_id,
                'country_id'     => $r->country_id,
                'status'         => $r->get('status', 'مدفوع'),
                'visit_date'     => $r->visit_date
            ]);
        }

        return response()->json($lastVisit->load(['doctor','clinicUnit','governorate','country']), 201);
    }

    public function visitsDestroy(Visit $visit)
    {
        $this->checkPermission();
        $visit->delete(); return response()->json(['ok'=>true]);
    }

    public function visitsUpdate(Request $r, Visit $visit)
    {
        $this->checkPermission();
        $r->validate([
            'patient_name'   => 'nullable|string|max:255',
            'doctor_id'      => 'required|exists:doctors,id',
            'clinic_unit_id' => 'required|exists:clinic_units,id',
            'governorate_id' => 'nullable|exists:governorates,id',
            'country_id'     => 'nullable|exists:countries,id',
            'visit_date'     => 'required|date',
        ]);
        
        $visit->update($r->only(['patient_name', 'doctor_id', 'clinic_unit_id', 'governorate_id', 'country_id', 'visit_date']));
        return response()->json($visit->load(['doctor','clinicUnit','governorate','country']));
    }

    // ========== EYE TESTS ==========
    public function eyeTestsIndex(Request $r)
    {
        $q = EyeTest::with(['testType'])
            ->when($r->start_date && $r->end_date, function($q) use ($r) {
                $start = $r->start_date;
                $end = $r->end_date;
                if (strlen($start) === 7) $start = $start . '-01';
                if (strlen($end) === 7) $end = \Carbon\Carbon::parse($end)->endOfMonth()->toDateString();
                $q->whereBetween('test_date', [$start, $end]);
            })
            ->latest('id');

        if ($r->get('per_page') == 1000) {
            return response()->json(['data' => $q->get()]);
        }

        return response()->json($q->paginate($r->get('per_page', 20)));
    }

    public function eyeTestsStore(Request $r)
    {
        $this->checkPermission();
        $r->validate([
            'test_type_id'  => 'required|exists:test_types,id',
            'test_date'     => 'required|date',
            'quantity'      => 'nullable|integer|min:1'
        ]);

        $qty = $r->get('quantity', 1);

        $defaultDoc = Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
        $defaultUnit = ClinicUnit::first();

        $lastTest = null;
        for ($i = 0; $i < $qty; $i++) {
            $visit = Visit::create([
                'patient_name'   => 'قيد إحصائي فحص',
                'doctor_id'      => $defaultDoc ? $defaultDoc->id : 1,
                'clinic_unit_id' => $defaultUnit ? $defaultUnit->id : 1,
                'status'         => 'مدفوع',
                'visit_date'     => $r->test_date
            ]);

            $lastTest = EyeTest::create([
                'visit_id'     => $visit->id,
                'test_type_id' => $r->test_type_id,
                'test_date'    => $r->test_date
            ]);
        }

        return response()->json($lastTest->load('testType'), 201);
    }

    public function eyeTestsDestroy(EyeTest $eyeTest)
    {
        $this->checkPermission();
        $visit = $eyeTest->visit;
        $eyeTest->delete();
        if ($visit && $visit->patient_name === 'قيد إحصائي فحص') {
            $visit->delete();
        }
        return response()->json(['ok'=>true]);
    }

    public function eyeTestsUpdate(Request $r, EyeTest $eyeTest)
    {
        $this->checkPermission();
        $r->validate([
            'test_type_id'  => 'required|exists:test_types,id',
            'test_date'     => 'required|date'
        ]);
        $eyeTest->update($r->only(['test_type_id', 'test_date']));
        // Also update the parent visit date just in case
        if ($eyeTest->visit) {
            $eyeTest->visit->update(['visit_date' => $r->test_date]);
        }
        return response()->json($eyeTest->load('testType'));
    }

    // ========== LAB TESTS ==========
    public function labTestsIndex(Request $r)
    {
        $q = LabTest::with(['labTestType','visit'])
            ->when($r->start_date && $r->end_date, function($q) use ($r) {
                $start = $r->start_date;
                $end = $r->end_date;
                if (strlen($start) === 7) $start = $start . '-01';
                if (strlen($end) === 7) $end = \Carbon\Carbon::parse($end)->endOfMonth()->toDateString();
                $q->whereBetween('test_date', [$start, $end]);
            })
            ->latest('id');

        if ($r->get('per_page') == 1000) {
            return response()->json(['data' => $q->get()]);
        }

        return response()->json($q->paginate($r->get('per_page', 20)));
    }

    public function labTestsStore(Request $r)
    {
        $this->checkPermission();
        $r->validate([
            'lab_test_type_id' => 'required|exists:lab_test_types,id',
            'test_date'        => 'required|date',
            'quantity'         => 'nullable|integer|min:1'
        ]);

        $qty = $r->get('quantity', 1);

        $defaultDoc = Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
        $defaultUnit = ClinicUnit::first();

        $lastTest = null;
        for ($i = 0; $i < $qty; $i++) {
            $visit = Visit::create([
                'patient_name'   => 'قيد إحصائي تحليل',
                'doctor_id'      => $defaultDoc ? $defaultDoc->id : 1,
                'clinic_unit_id' => $defaultUnit ? $defaultUnit->id : 1,
                'status'         => 'مدفوع',
                'visit_date'     => $r->test_date
            ]);

            $lastTest = LabTest::create([
                'visit_id'         => $visit->id,
                'lab_test_type_id' => $r->lab_test_type_id,
                'test_date'        => $r->test_date
            ]);
        }

        return response()->json($lastTest->load('labTestType'), 201);
    }

    public function labTestsDestroy(LabTest $labTest)
    {
        $this->checkPermission();
        $visit = $labTest->visit;
        $labTest->delete();
        if ($visit && $visit->patient_name === 'قيد إحصائي تحليل') {
            $visit->delete();
        }
        return response()->json(['ok'=>true]);
    }

    public function labTestsUpdate(Request $r, LabTest $labTest)
    {
        $this->checkPermission();
        $r->validate([
            'lab_test_type_id'  => 'required|exists:lab_test_types,id',
            'test_date'         => 'required|date'
        ]);
        $labTest->update($r->only(['lab_test_type_id', 'test_date']));
        if ($labTest->visit) {
            $labTest->visit->update(['visit_date' => $r->test_date]);
        }
        return response()->json($labTest->load('labTestType'));
    }

    // ========== SURGERIES ==========
    public function surgeriesIndex(Request $r)
    {
        $defaultDoc = Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
        $defaultOp = OperationName::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();

        $q = Surgery::with(['doctor','operationName','sector','governorate','country'])
            ->when($r->start_date && $r->end_date, function($q) use ($r) {
                $start = $r->start_date;
                $end = $r->end_date;
                if (strlen($start) === 7) $start = $start . '-01';
                if (strlen($end) === 7) $end = \Carbon\Carbon::parse($end)->endOfMonth()->toDateString();
                $q->whereBetween('op_date', [$start, $end]);
            })
            ->when($r->type === 'surgeries_ops' && $defaultDoc, function($q) use ($defaultDoc, $defaultOp) {
                $q->whereNull('governorate_id')
                  ->whereNull('country_id')
                  ->where(function($q2) {
                      $q2->whereNull('sector_id')->orWhereNull('classification');
                  })
                  ->where(function($query) use ($defaultDoc, $defaultOp) {
                      $query->where('doctor_id', $defaultDoc->id)
                            ->orWhere(function($sub) use ($defaultDoc, $defaultOp) {
                                $sub->where('doctor_id', '!=', $defaultDoc->id)
                                    ->where('operation_name_id', '!=', $defaultOp->id);
                            });
                  });
            })
            ->when($r->type === 'surgeries_docs' && $defaultOp, function($q) use ($r, $defaultDoc, $defaultOp) {
                $q->whereNull('governorate_id')
                  ->whereNull('country_id')
                  ->whereNotNull('classification');
                if ($r->has('sector_id')) {
                    $q->where('sector_id', $r->sector_id);
                }
            })
            ->when($r->type === 'surgeries_cls' && $defaultDoc && $defaultOp, function($q) use ($defaultDoc, $defaultOp) {
                // Return only the classification×sector entries (saved via cls tab)
                $q->whereNull('governorate_id')
                  ->whereNull('country_id')
                  ->where('doctor_id', $defaultDoc->id)
                  ->where('operation_name_id', $defaultOp->id)
                  ->whereNotNull('sector_id')
                  ->whereNotNull('classification');
            })
            ->when($r->type === 'surgeries_govs' && $defaultDoc && $defaultOp, function($q) use ($defaultDoc, $defaultOp) {
                $q->where('doctor_id', $defaultDoc->id)
                  ->where('operation_name_id', $defaultOp->id)
                  ->whereNotNull('governorate_id');
            })
            ->when($r->type === 'surgeries_countries' && $defaultDoc && $defaultOp, function($q) use ($defaultDoc, $defaultOp) {
                $q->where('doctor_id', $defaultDoc->id)
                  ->where('operation_name_id', $defaultOp->id)
                  ->whereNotNull('country_id');
            })
            ->latest('id');

        if ($r->get('per_page') == 1000 || $r->get('per_page') == 2000) {
            $results = $q->get()->map(function($s) {
                return [
                    'id'             => $s->id,
                    'classification' => $s->classification,
                    'sector_name'    => $s->sector?->name,
                    'sector_id'      => $s->sector_id,
                    'quantity'       => $s->quantity ?? 1,
                    'op_date'        => $s->op_date,
                    'doctor_id'      => $s->doctor_id,
                    'governorate_id' => $s->governorate_id,
                    'country_id'     => $s->country_id,
                ];
            });
            return response()->json(['data' => $results]);
        }

        return response()->json($q->paginate($r->get('per_page', 20)));
    }

    public function surgeriesStore(Request $r)
    {
        $this->checkPermission();
        $r->validate([
            'patient_name'      => 'nullable|string|max:255',
            'doctor_id'         => 'required|exists:doctors,id',
            'operation_name_id' => 'required|exists:operation_names,id',
            'sector_id'         => 'nullable|exists:sectors,id',
            'governorate_id'    => 'nullable|exists:governorates,id',
            'country_id'        => 'nullable|exists:countries,id',
            'op_date'           => 'required|date',
            'classification'    => 'nullable|string',
            'quantity'          => 'nullable|integer|min:1'
        ]);

        $qty = $r->get('quantity', 1);
        $patientName = $r->get('patient_name') ?: 'قيد إحصائي';

        $lastSurgery = null;
        for ($i = 0; $i < $qty; $i++) {
            $lastSurgery = Surgery::create([
                'patient_name'      => $patientName,
                'doctor_id'         => $r->doctor_id,
                'operation_name_id' => $r->operation_name_id,
                'sector_id'         => $r->sector_id,
                'governorate_id'    => $r->governorate_id,
                'country_id'        => $r->country_id,
                'op_date'           => $r->op_date,
                'classification'    => $r->classification
            ]);
        }

        return response()->json($lastSurgery->load(['doctor','operationName','sector','governorate','country']), 201);
    }

    public function surgeriesDestroy(Surgery $surgery)
    {
        $this->checkPermission();
        $surgery->delete(); return response()->json(['ok'=>true]);
    }

    public function surgeriesUpdate(Request $r, Surgery $surgery)
    {
        $this->checkPermission();
        $r->validate([
            'patient_name'      => 'nullable|string|max:255',
            'doctor_id'         => 'required|exists:doctors,id',
            'operation_name_id' => 'required|exists:operation_names,id',
            'sector_id'         => 'required|exists:sectors,id',
            'governorate_id'    => 'nullable|exists:governorates,id',
            'country_id'        => 'nullable|exists:countries,id',
            'op_date'           => 'required|date',
            'classification'    => 'nullable|string',
        ]);
        
        $surgery->update($r->only(['patient_name', 'doctor_id', 'operation_name_id', 'sector_id', 'governorate_id', 'country_id', 'op_date', 'classification']));
        return response()->json($surgery->load(['doctor','operationName','sector','governorate','country']));
    }

    // ========== DOCTOR OPERATION STATS ==========
    public function doctorOpStatsIndex(Request $r)
    {
        $month = $r->get('month');
        if (!$month) return response()->json([]);
        // Normalize to first day of month
        $statMonth = strlen($month) === 7 ? $month . '-01' : $month;

        $stats = DoctorOperationStat::with(['doctor', 'operationName'])
            ->where('stat_month', $statMonth)
            ->get()
            ->map(fn($s) => [
                'id'                => $s->id,
                'doctor_id'         => $s->doctor_id,
                'doctor_name'       => $s->doctor->name ?? '—',
                'operation_name_id' => $s->operation_name_id,
                'operation_name'    => $s->operationName->name ?? '—',
                'classification'    => $s->classification,
                'quantity'          => $s->quantity,
                'stat_month'        => $s->stat_month,
            ]);

        return response()->json($stats);
    }

    public function doctorOpStatsSave(Request $r)
    {
        $this->checkPermission();
        $r->validate([
            'month'      => 'required|string',
            'entries'    => 'required|array',
            'entries.*.doctor_id'         => 'required|exists:doctors,id',
            'entries.*.operation_name_id' => 'required|exists:operation_names,id',
            'entries.*.quantity'          => 'required|integer|min:0',
        ]);

        $month = $r->month;
        $statMonth = strlen($month) === 7 ? $month . '-01' : $month;

        // Clear existing data for this month first
        DoctorOperationStat::where('stat_month', $statMonth)->delete();

        $entries = collect($r->entries)->filter(fn($e) => ($e['quantity'] ?? 0) > 0);

        foreach ($entries as $entry) {
            // Get classification from operation name if not provided
            $op = OperationName::find($entry['operation_name_id']);
            $classification = $entry['classification'] ?? $op->classification ?? null;

            DoctorOperationStat::create([
                'doctor_id'         => $entry['doctor_id'],
                'operation_name_id' => $entry['operation_name_id'],
                'classification'    => $classification,
                'quantity'          => $entry['quantity'],
                'stat_month'        => $statMonth,
            ]);
        }

        return response()->json(['ok' => true, 'saved' => $entries->count()]);
    }

    public function doctorOpStatsClear(Request $r)
    {
        $this->checkPermission();
        $r->validate(['month' => 'required|string']);
        $month = $r->month;
        $statMonth = strlen($month) === 7 ? $month . '-01' : $month;
        DoctorOperationStat::where('stat_month', $statMonth)->delete();
        return response()->json(['ok' => true]);
    }

    // ========== FORM DATA (for dropdowns) ==========
    public function formData()
    {
        return response()->json([
            'doctors'         => Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->get(['id','name']),
            'clinicUnits'     => ClinicUnit::all(['id','name']),
            'governorates'    => Governorate::all(['id','name']),
            'countries'       => Country::all(['id','name']),
            'testTypes'       => TestType::all(['id','name']),
            'labTestTypes'    => LabTestType::all(['id','name']),
            'operationNames'  => OperationName::orderBy('display_order', 'asc')->orderBy('name', 'asc')->get(['id','name','classification']),
            'sectors'         => Sector::all(['id','name']),
            'classifications' => \App\Models\Classification::orderBy('display_order', 'asc')->orderBy('id', 'asc')->get(['id','name']),
        ]);
    }
}
