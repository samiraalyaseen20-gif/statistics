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
            'type'       => 'required|in:visits_doctors,visits_govs,visits_countries,surgeries_ops,surgeries_docs,eye_tests,lab_tests'
        ]);

        $start = $r->start_date;
        $end = $r->end_date;

        switch ($r->type) {
            case 'visits_doctors':
                Visit::whereBetween('visit_date', [$start, $end])
                    ->whereNull('governorate_id')
                    ->whereNull('country_id')
                    ->whereDoesntHave('eyeTests')
                    ->whereDoesntHave('labTests')
                    ->delete();
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
                $defaultDoc = Doctor::first();
                if ($defaultDoc) {
                    Surgery::whereBetween('op_date', [$start, $end])
                        ->where('doctor_id', $defaultDoc->id)
                        ->delete();
                }
                break;
            case 'surgeries_docs':
                $defaultOp = OperationName::first();
                if ($defaultOp) {
                    Surgery::whereBetween('op_date', [$start, $end])
                        ->where('operation_name_id', $defaultOp->id)
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
        $q = Visit::with(['doctor','clinicUnit','governorate','country'])
            ->when($r->month, fn($q,$m) => $q->whereYear('visit_date', substr($m,0,4))->whereMonth('visit_date', substr($m,5,2)))
            ->when($r->start_date && $r->end_date, fn($q) => $q->whereBetween('visit_date', [$r->start_date, $r->end_date]))
            ->latest('id')->paginate($r->get('per_page', 20));
        return response()->json($q);
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
            ->when($r->start_date && $r->end_date, fn($q) => $q->whereBetween('test_date', [$r->start_date, $r->end_date]))
            ->latest('id')->paginate($r->get('per_page', 20));
        return response()->json($q);
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

        $defaultDoc = Doctor::first();
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
            ->when($r->start_date && $r->end_date, fn($q) => $q->whereBetween('test_date', [$r->start_date, $r->end_date]))
            ->latest('id')->paginate($r->get('per_page', 20));
        return response()->json($q);
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

        $defaultDoc = Doctor::first();
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
        $q = Surgery::with(['doctor','operationName','sector','governorate','country'])
            ->when($r->month, fn($q,$m) => $q->whereYear('op_date', substr($m,0,4))->whereMonth('op_date', substr($m,5,2)))
            ->when($r->start_date && $r->end_date, fn($q) => $q->whereBetween('op_date', [$r->start_date, $r->end_date]))
            ->latest('id')->paginate($r->get('per_page', 20));
        return response()->json($q);
    }

    public function surgeriesStore(Request $r)
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
                'op_date'           => $r->op_date
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
        ]);
        
        $surgery->update($r->only(['patient_name', 'doctor_id', 'operation_name_id', 'sector_id', 'governorate_id', 'country_id', 'op_date']));
        return response()->json($surgery->load(['doctor','operationName','sector','governorate','country']));
    }

    // ========== FORM DATA (for dropdowns) ==========
    public function formData()
    {
        return response()->json([
            'doctors'        => Doctor::all(['id','name']),
            'clinicUnits'    => ClinicUnit::all(['id','name']),
            'governorates'   => Governorate::all(['id','name']),
            'countries'      => Country::all(['id','name']),
            'testTypes'      => TestType::all(['id','name']),
            'labTestTypes'   => LabTestType::all(['id','name']),
            'operationNames' => OperationName::all(['id','name','classification']),
            'sectors'        => Sector::all(['id','name']),
        ]);
    }
}
