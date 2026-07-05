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
use App\Models\OperationName;
use App\Models\Sector;
use App\Models\DoctorOperationStat;
use App\Models\DoctorSurgeryStat;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $r)
    {
        // 1. Date Range Filters (Defaults to dynamic min/max date range)
        $start_date = $r->get('start_date', Visit::min('visit_date') ?: '2026-01-01');
        $end_date   = $r->get('end_date', Visit::max('visit_date') ?: date('Y-m-d'));

        if (strlen($start_date) === 7) {
            $start_date = $start_date . '-01';
        }
        if (strlen($end_date) === 7) {
            $end_date = \Carbon\Carbon::parse($end_date)->endOfMonth()->toDateString();
        }

        // Extract month and year for display
        $time = strtotime($start_date);
        $year  = date('Y', $time);
        $month = date('m', $time);

        // 2. Advanced Dropdown Filters
        $doctor_id      = $r->get('doctor_id');
        $clinic_unit_id = $r->get('clinic_unit_id');
        $sector_id      = $r->get('sector_id');
        $governorate_id = $r->get('governorate_id');
        $country_id     = $r->get('country_id');

        // 3. Build filtered base queries
        $editedMonths = Visit::where('patient_name', 'قيد إحصائي')
            ->selectRaw("DISTINCT DATE_FORMAT(visit_date, '%Y-%m') as month")
            ->pluck('month')
            ->toArray();

        $visitsQuery = Visit::whereBetween('visit_date', [$start_date, $end_date])
            ->whereNotIn('patient_name', ['قيد إحصائي فحص', 'قيد إحصائي تحليل']);

        if (!empty($editedMonths)) {
            $visitsQuery->where(function($q) use ($editedMonths) {
                $q->where('patient_name', '!=', 'مريض مجهول')
                  ->orWhereNotIn(\Illuminate\Support\Facades\DB::raw("DATE_FORMAT(visit_date, '%Y-%m')"), $editedMonths);
            });
        }

        if ($doctor_id)      $visitsQuery->where('doctor_id', $doctor_id);
        if ($clinic_unit_id) $visitsQuery->where('clinic_unit_id', $clinic_unit_id);
        if ($governorate_id) $visitsQuery->where('governorate_id', $governorate_id);
        if ($country_id)     $visitsQuery->where('country_id', $country_id);

        $docVisitsQuery = clone $visitsQuery;
        if (!$governorate_id) {
            $docVisitsQuery->whereNull('governorate_id');
        }
        if (!$country_id) {
            $docVisitsQuery->whereNull('country_id');
        }

        $surgeriesQuery = Surgery::whereBetween('op_date', [$start_date, $end_date]);
        if ($doctor_id)      $surgeriesQuery->where('doctor_id', $doctor_id);
        if ($sector_id)      $surgeriesQuery->where('sector_id', $sector_id);
        if ($governorate_id) $surgeriesQuery->where('governorate_id', $governorate_id);
        if ($country_id)     $surgeriesQuery->where('country_id', $country_id);

        $docSurgeriesQuery = clone $surgeriesQuery;
        if (!$governorate_id) {
            $docSurgeriesQuery->whereNull('governorate_id');
        }
        if (!$country_id) {
            $docSurgeriesQuery->whereNull('country_id');
        }

        $eyeTestsQuery = EyeTest::whereBetween('test_date', [$start_date, $end_date]);
        if ($doctor_id || $clinic_unit_id || $governorate_id || $country_id) {
            $eyeTestsQuery->whereHas('visit', function($q) use ($doctor_id, $clinic_unit_id, $governorate_id, $country_id) {
                if ($doctor_id)      $q->where('doctor_id', $doctor_id);
                if ($clinic_unit_id) $q->where('clinic_unit_id', $clinic_unit_id);
                if ($governorate_id) $q->where('governorate_id', $governorate_id);
                if ($country_id)     $q->where('country_id', $country_id);
            });
        }

        $labTestsQuery = LabTest::whereBetween('test_date', [$start_date, $end_date]);
        if ($doctor_id || $clinic_unit_id || $governorate_id || $country_id) {
            $labTestsQuery->whereHas('visit', function($q) use ($doctor_id, $clinic_unit_id, $governorate_id, $country_id) {
                if ($doctor_id)      $q->where('doctor_id', $doctor_id);
                if ($clinic_unit_id) $q->where('clinic_unit_id', $clinic_unit_id);
                if ($governorate_id) $q->where('governorate_id', $governorate_id);
                if ($country_id)     $q->where('country_id', $country_id);
            });
        }

        // 4. Fetch statistics using clones of the base queries

        // جدول (1): الاستشاريات بالوحدة الطبية
        $consultations = (clone $docVisitsQuery)
            ->select('clinic_unit_id', DB::raw('count(*) as total'))
            ->groupBy('clinic_unit_id')
            ->get()->map(fn($v) => ['unit' => $v->clinicUnit->name ?? '—', 'total' => $v->total]);

        // جدول (2): مراجعي الاستشارية لكل طبيب
        $visitsByDoctor = (clone $docVisitsQuery)
            ->join('doctors', 'visits.doctor_id', '=', 'doctors.id')
            ->select('visits.doctor_id', 'doctors.name as doctor', 'doctors.display_order', DB::raw('count(*) as total'))
            ->groupBy('visits.doctor_id', 'doctors.name', 'doctors.display_order')
            ->orderBy('doctors.display_order', 'asc')
            ->orderBy('doctors.name', 'asc')
            ->get()->map(fn($v) => ['doctor' => $v->doctor ?? '—', 'total' => $v->total]);

        // جدول (3): ديمغرافي داخل العراق (استشارية)
        $visitsByGov = (clone $visitsQuery)
            ->whereNotNull('governorate_id')
            ->select('governorate_id', DB::raw('count(*) as total'))
            ->groupBy('governorate_id')
            ->get()
            ->map(fn($v) => [
                'gov' => $this->normalizeGovName($v->governorate->name ?? '—'),
                'total' => $v->total
            ])
            ->groupBy('gov')
            ->map(fn($g, $key) => ['gov' => $key, 'total' => $g->sum('total')])
            ->values();

        // جدول (4): ديمغرافي خارج العراق (استشارية)
        $visitsByCountry = (clone $visitsQuery)
            ->whereNotNull('country_id')
            ->select('country_id', DB::raw('count(*) as total'))
            ->groupBy('country_id')
            ->get()
            ->map(fn($v) => [
                'country' => $this->normalizeCountryName($v->country->name ?? '—'),
                'total' => $v->total
            ])
            ->groupBy('country')
            ->map(fn($g, $key) => ['country' => $key, 'total' => $g->sum('total')])
            ->values();

        // جدول (5): الفحوصات البصرية بالنوع
        $eyeTestsByType = (clone $eyeTestsQuery)
            ->select('test_type_id', DB::raw('count(*) as total'))
            ->groupBy('test_type_id')
            ->get()->map(fn($v) => ['type' => $v->testType->name ?? '—', 'total' => $v->total]);

        // جدول (6): مراجعو المختبر وتحاليله
        $labVisitCount = (clone $visitsQuery)->whereHas('labTests')->count();
        $labTestsByType = (clone $labTestsQuery)
            ->select('lab_test_type_id', DB::raw('count(*) as total'))
            ->groupBy('lab_test_type_id')
            ->get()->map(fn($v) => ['type' => $v->labTestType->name ?? '—', 'total' => $v->total]);

        // جدول (7): تصنيف العمليات × القطاع
        // المصدر الأول: سجلات CLS (defaultDoc+defaultOp مع classification و sector) - إدخال تجميعي مباشر
        // المصدر الثاني: سجلات العمليات الفعلية للأطباء مع classification و sector (fallback)
        $defaultDoc = \App\Models\Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
        $defaultOp  = \App\Models\OperationName::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();

        // المصدر 1: سجلات CLS المباشرة (من تبويب التصنيف)
        $clsDirectQuery = Surgery::whereBetween('op_date', [$start_date, $end_date])
            ->whereNull('governorate_id')
            ->whereNull('country_id')
            ->where('patient_name', 'قيد إحصائي تصنيف')
            ->whereNotNull('sector_id')
            ->whereNotNull('classification');

        $clsDirectCount = (clone $clsDirectQuery)->count();

        if ($clsDirectCount > 0) {
            // استخدام سجلات CLS المباشرة إذا تم إدخالها من تبويب التصنيف
            $surgeriesByCatSector = $clsDirectQuery
                ->join('sectors','surgeries.sector_id','=','sectors.id')
                ->select('surgeries.classification','sectors.name as sector', DB::raw('count(*) as total'))
                ->groupBy('surgeries.classification','sectors.name')
                ->get();
        } else {
            // Fallback: جلب من سجلات العمليات الفعلية للأطباء (مع classification و sector)
            $surgeriesByCatSector = Surgery::whereBetween('op_date', [$start_date, $end_date])
                ->whereNull('governorate_id')
                ->whereNull('country_id')
                ->whereNotNull('sector_id')
                ->whereNotNull('classification')
                ->join('sectors','surgeries.sector_id','=','sectors.id')
                ->select('surgeries.classification','sectors.name as sector', DB::raw('count(*) as total'))
                ->groupBy('surgeries.classification','sectors.name')
                ->get();
        }

        // جدول (8): ديمغرافي داخل العراق (عمليات)
        $surgeriesByGov = (clone $surgeriesQuery)
            ->whereNotNull('governorate_id')
            ->select('governorate_id', DB::raw('count(*) as total'))
            ->groupBy('governorate_id')
            ->get()
            ->map(fn($v) => [
                'gov' => $this->normalizeGovName($v->governorate->name ?? '—'),
                'total' => $v->total
            ])
            ->groupBy('gov')
            ->map(fn($g, $key) => ['gov' => $key, 'total' => $g->sum('total')])
            ->values();

        // جدول (9): ديمغرافي خارج العراق (عمليات)
        $surgeriesByCountry = (clone $surgeriesQuery)
            ->whereNotNull('country_id')
            ->select('country_id', DB::raw('count(*) as total'))
            ->groupBy('country_id')
            ->get()
            ->map(fn($v) => [
                'country' => $this->normalizeCountryName($v->country->name ?? '—'),
                'total' => $v->total
            ])
            ->groupBy('country')
            ->map(fn($g, $key) => ['country' => $key, 'total' => $g->sum('total')])
            ->values();

        $statMonthStart = substr($start_date, 0, 7) . '-01';
        $statMonthEnd   = substr($end_date,   0, 7) . '-01';

        // جدول (10): إجمالي العمليات الجراحية لكل طبيب (بيانات حقيقية من الجدول المستقل)
        $docSurgeryStatsQuery = DoctorSurgeryStat::with(['doctor', 'sector'])
            ->whereBetween('stat_month', [$statMonthStart, $statMonthEnd]);

        if ($doctor_id) {
            $docSurgeryStatsQuery->where('doctor_id', $doctor_id);
        }

        $surgeriesByDoctorCatSector = $docSurgeryStatsQuery->get()
            ->map(fn($item) => (object)[
                'doctor' => $item->doctor->name ?? '—',
                'classification' => $item->classification,
                'sector' => $item->sector_key,
                'total' => $item->quantity
            ]);

        // الملف الثاني: تفصيلي لكل طبيب (اسم العملية + العدد)
        $surgeryDetailByDoctor = (clone $docSurgeriesQuery)
            ->join('doctors','surgeries.doctor_id','=','doctors.id')
            ->join('operation_names','surgeries.operation_name_id','=','operation_names.id')
            ->select('doctors.name as doctor','doctors.display_order as doc_order','operation_names.name as op','operation_names.display_order as op_order','surgeries.classification', DB::raw('count(*) as total'))
            ->groupBy('doctors.name','doctors.display_order','operation_names.name','operation_names.display_order','surgeries.classification')
            ->orderBy('doctors.display_order', 'asc')
            ->orderBy('operation_names.display_order', 'asc')
            ->get()->groupBy('doctor');

        $doctorOpStatsRaw = DoctorOperationStat::with(['doctor', 'operationName'])
            ->whereBetween('stat_month', [$statMonthStart, $statMonthEnd])
            ->where('quantity', '>', 0);

        if ($doctor_id) {
            $doctorOpStatsRaw->where('doctor_id', $doctor_id);
        }

        $doctorOpStatsRaw = $doctorOpStatsRaw->get();

        $combinedDetailedOps = $doctorOpStatsRaw->groupBy('operation_name_id')
            ->map(fn($group) => (object)[
                'op'             => $group->first()->operationName->name ?? '—',
                'classification' => $group->first()->classification ?? ($group->first()->operationName->classification ?? '—'),
                'total'          => $group->sum('quantity'),
                'op_order'       => $group->first()->operationName->display_order ?? 0
            ])->sortBy('op_order')->values();

        $flatDetailedOps = $doctorOpStatsRaw->map(fn($s) => (object)[
            'doctor_name'    => $s->doctor->name ?? '—',
            'op'             => $s->operationName->name ?? '—',
            'classification' => $s->classification ?? ($s->operationName->classification ?? '—'),
            'total'          => $s->quantity,
            'doc_order'      => $s->doctor->display_order ?? 0,
            'op_order'       => $s->operationName->display_order ?? 0,
        ])->sort(function($a, $b) {
            if ($a->doc_order !== $b->doc_order) {
                return $a->doc_order <=> $b->doc_order;
            }
            return $a->op_order <=> $b->op_order;
        })->values();

        $grandDetailTotal = $doctorOpStatsRaw->sum('quantity');

        $doctorOpStatsByDoctor = $doctorOpStatsRaw
            ->groupBy(fn($s) => $s->doctor->name ?? '—')
            ->map(fn($group) => $group->groupBy('operation_name_id')
                ->map(fn($subGroup) => (object)[
                    'op'            => $subGroup->first()->operationName->name ?? '—',
                    'classification'=> $subGroup->first()->classification ?? ($subGroup->first()->operationName->classification ?? '—'),
                    'total'         => $subGroup->sum('quantity'),
                    'doc_order'     => $subGroup->first()->doctor->display_order ?? 0,
                    'op_order'      => $subGroup->first()->operationName->display_order ?? 0,
                ])->sortBy('op_order')->values()
            );

        // Totals
        $totalVisits    = (clone $docVisitsQuery)->count();
        $totalEyeTests  = (clone $eyeTestsQuery)->count();
        
        // المجموع الكلي للعمليات الجراحية للأطباء من الجدول المستقل تماماً
        $totalSurgeries = DoctorSurgeryStat::whereBetween('stat_month', [$statMonthStart, $statMonthEnd])
            ->when($doctor_id, fn($q) => $q->where('doctor_id', $doctor_id))
            ->sum('quantity');

        $filterDoctors      = Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->get();
        $filterClinicUnits  = ClinicUnit::orderBy('name')->get();
        $filterSectors      = Sector::orderBy('name')->get();
        $filterGovernorates = Governorate::orderBy('name')->get();
        $filterCountries    = Country::orderBy('name')->get();
        $filterTestTypes    = \App\Models\TestType::orderBy('name')->get();
        $filterLabTestTypes = \App\Models\LabTestType::orderBy('name')->get();
        $filterOperations   = OperationName::orderBy('display_order', 'asc')->orderBy('name', 'asc')->get();
        $filterClassifications = \App\Models\Classification::orderBy('display_order', 'asc')->orderBy('id', 'asc')->get();

        $showCopyright = Setting::get('show_copyright', '1') === '1';

        if ($r->has('print')) {
            return view('pages.print_report', compact(
                'consultations','visitsByDoctor','visitsByGov','visitsByCountry',
                'eyeTestsByType','labVisitCount','labTestsByType',
                'surgeriesByCatSector','surgeriesByGov','surgeriesByCountry',
                'surgeriesByDoctorCatSector','surgeryDetailByDoctor',
                'doctorOpStatsByDoctor', 'combinedDetailedOps', 'flatDetailedOps', 'grandDetailTotal',
                'totalVisits','totalEyeTests','totalSurgeries',
                'year','month','start_date','end_date',
                'doctor_id','clinic_unit_id','sector_id','governorate_id','country_id',
                'filterDoctors','filterClinicUnits','filterSectors','filterGovernorates','filterCountries',
                'showCopyright'
            ));
        }

        return view('main_screen', compact(
            'consultations','visitsByDoctor','visitsByGov','visitsByCountry',
            'eyeTestsByType','labVisitCount','labTestsByType',
            'surgeriesByCatSector','surgeriesByGov','surgeriesByCountry',
            'surgeriesByDoctorCatSector','surgeryDetailByDoctor',
            'doctorOpStatsByDoctor', 'combinedDetailedOps', 'flatDetailedOps', 'grandDetailTotal',
            'totalVisits','totalEyeTests','totalSurgeries',
            'year','month','start_date','end_date',
            'doctor_id','clinic_unit_id','sector_id','governorate_id','country_id',
            'filterDoctors','filterClinicUnits','filterSectors','filterGovernorates','filterCountries',
            'filterTestTypes','filterLabTestTypes', 'filterOperations', 'filterClassifications',
            'showCopyright'
        ));
    }

    public function comparisonData(Request $r)
    {
        $editedMonths = Visit::where('patient_name', 'قيد إحصائي')
            ->selectRaw("DISTINCT DATE_FORMAT(visit_date, '%Y-%m') as month")
            ->pluck('month')
            ->toArray();

        $getSideStats = function($docId, $startDate, $endDate, $opClass = null) use ($editedMonths) {
            $startDate = $startDate ?: '2026-05-01';
            $endDate   = $endDate ?: '2026-05-31';

            if (strlen($startDate) === 7) {
                $startDate = $startDate . '-01';
            }
            if (strlen($endDate) === 7) {
                $endDate = \Carbon\Carbon::parse($endDate)->endOfMonth()->toDateString();
            }

            $visitsQuery = Visit::whereBetween('visit_date', [$startDate, $endDate])
                ->whereNotIn('patient_name', ['قيد إحصائي فحص', 'قيد إحصائي تحليل']);

            if (!empty($editedMonths)) {
                $visitsQuery->where(function($q) use ($editedMonths) {
                    $q->where('patient_name', '!=', 'مريض مجهول')
                      ->orWhereNotIn(\Illuminate\Support\Facades\DB::raw("DATE_FORMAT(visit_date, '%Y-%m')"), $editedMonths);
                });
            }

            if ($docId) $visitsQuery->where('doctor_id', $docId);

            $surgeriesQuery = Surgery::whereBetween('op_date', [$startDate, $endDate]);
            if ($docId) $surgeriesQuery->where('doctor_id', $docId);
            if ($opClass) {
                $surgeriesQuery->where('surgeries.classification', $opClass);
            }

            $docVisitsQuery = (clone $visitsQuery)
                ->whereNull('governorate_id')
                ->whereNull('country_id');

            $docSurgeriesQuery = (clone $surgeriesQuery)
                ->whereNull('governorate_id')
                ->whereNull('country_id');

            // Totals
            $totalVisits    = (clone $docVisitsQuery)->count();
            
            $sideStatStart = substr($startDate, 0, 7) . '-01';
            $sideStatEnd   = substr($endDate,   0, 7) . '-01';
            
            $totalSurgeries = DoctorSurgeryStat::whereBetween('stat_month', [$sideStatStart, $sideStatEnd])
                ->when($docId, fn($q) => $q->where('doctor_id', $docId))
                ->sum('quantity');

            // فحوصات بصرية — مستقلة لا تتأثر بالطبيب أو تصنيف العملية
            $eyeTestsQuery = \App\Models\EyeTest::whereBetween('test_date', [$startDate, $endDate]);
            $totalEyeTests = (clone $eyeTestsQuery)->count();
            $eyeTestsByType = (clone $eyeTestsQuery)
                ->select('test_type_id', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                ->groupBy('test_type_id')
                ->get()->map(fn($v) => ['type' => $v->testType->name ?? '—', 'total' => $v->total]);

            // جدول 1: الاستشاريات بالوحدة الطبية
            $consultations = (clone $docVisitsQuery)
                ->select('clinic_unit_id', DB::raw('count(*) as total'))
                ->groupBy('clinic_unit_id')
                ->get()->map(fn($v) => ['unit' => $v->clinicUnit->name ?? '—', 'total' => $v->total]);

            // جدول 2: مراجعو كل طبيب
            $visitsByDoctor = (clone $docVisitsQuery)
                ->join('doctors', 'visits.doctor_id', '=', 'doctors.id')
                ->select('visits.doctor_id', 'doctors.name as doctor', 'doctors.display_order', DB::raw('count(*) as total'))
                ->groupBy('visits.doctor_id', 'doctors.name', 'doctors.display_order')
                ->orderBy('doctors.display_order', 'asc')
                ->orderBy('doctors.name', 'asc')
                ->get()->map(fn($v) => ['doctor' => $v->doctor ?? '—', 'total' => $v->total]);

            // جدول 3: داخل العراق
            $visitsByGov = (clone $visitsQuery)
                ->whereNotNull('governorate_id')
                ->select('governorate_id', DB::raw('count(*) as total'))
                ->groupBy('governorate_id')
                ->get()
                ->map(fn($v) => [
                    'gov' => $this->normalizeGovName($v->governorate->name ?? '—'),
                    'total' => $v->total
                ])
                ->groupBy('gov')
                ->map(fn($g, $key) => ['gov' => $key, 'total' => $g->sum('total')])
                ->values();

            // جدول 4: خارج العراق
            $visitsByCountry = (clone $visitsQuery)
                ->whereNotNull('country_id')
                ->select('country_id', DB::raw('count(*) as total'))
                ->groupBy('country_id')
                ->get()
                ->map(fn($v) => [
                    'country' => $this->normalizeCountryName($v->country->name ?? '—'),
                    'total' => $v->total
                ])
                ->groupBy('country')
                ->map(fn($g, $key) => ['country' => $key, 'total' => $g->sum('total')])
                ->values();

            // جدول 8: داخل العراق (عمليات)
            $surgeriesByGov = (clone $surgeriesQuery)
                ->whereNotNull('governorate_id')
                ->select('governorate_id', DB::raw('count(*) as total'))
                ->groupBy('governorate_id')
                ->get()
                ->map(fn($v) => [
                    'gov' => $this->normalizeGovName($v->governorate->name ?? '—'),
                    'total' => $v->total
                ])
                ->groupBy('gov')
                ->map(fn($g, $key) => ['gov' => $key, 'total' => $g->sum('total')])
                ->values();

            // جدول 9: خارج العراق (عمليات)
            $surgeriesByCountry = (clone $surgeriesQuery)
                ->whereNotNull('country_id')
                ->select('country_id', DB::raw('count(*) as total'))
                ->groupBy('country_id')
                ->get()
                ->map(fn($v) => [
                    'country' => $this->normalizeCountryName($v->country->name ?? '—'),
                    'total' => $v->total
                ])
                ->groupBy('country')
                ->map(fn($g, $key) => ['country' => $key, 'total' => $g->sum('total')])
                ->values();

            // جدول 7: تصنيف العمليات
            $surgeriesByCat = (clone $docSurgeriesQuery)
                ->join('operation_names','surgeries.operation_name_id','=','operation_names.id')
                ->select('operation_names.classification', DB::raw('count(*) as total'))
                ->groupBy('operation_names.classification')
                ->get()->map(fn($v) => ['classification' => $v->classification, 'total' => $v->total]);

            // جدول 10: عمليات كل طبيب (الإجمالي) من الجدول المستقل
            $surgsByDoctor = DoctorSurgeryStat::with('doctor')
                ->whereBetween('stat_month', [$sideStatStart, $sideStatEnd])
                ->when($docId, fn($q) => $q->where('doctor_id', $docId))
                ->get()
                ->groupBy('doctor_id')
                ->map(fn($group) => [
                    'doctor' => $group->first()->doctor->name ?? '—',
                    'total'  => $group->sum('quantity')
                ])->values();

            // تفصيلي: اسم العملية لكل طبيب
            $surgDetailByDoctor = (clone $docSurgeriesQuery)
                ->join('doctors','surgeries.doctor_id','=','doctors.id')
                ->join('operation_names','surgeries.operation_name_id','=','operation_names.id')
                ->select('doctors.name as doctor','doctors.display_order as doc_order','operation_names.name as op','operation_names.display_order as op_order','operation_names.classification', DB::raw('count(*) as total'))
                ->groupBy('doctors.name','doctors.display_order','operation_names.name','operation_names.display_order','operation_names.classification')
                ->get()->groupBy('doctor')
                ->map(fn($group) => $group->sortBy('op_order')->values());

            // إجمالي التفصيلي (كل الأطباء مجمعة)
            $combinedOps = $surgDetailByDoctor->flatten(1)
                ->groupBy('op')
                ->map(fn($g) => (object)[
                    'op'             => $g->first()['op'],
                    'classification' => $g->first()['classification'],
                    'total'          => $g->sum('total'),
                ])->sortByDesc('total')->values();

            // عمليات مفصلة من الجدول المستقل (doctor_operation_stats)
            $sideStatStart = substr($startDate, 0, 7) . '-01';
            $sideStatEnd   = substr($endDate,   0, 7) . '-01';
            $sideOpStatsRaw = DoctorOperationStat::with(['doctor', 'operationName'])
                ->whereBetween('stat_month', [$sideStatStart, $sideStatEnd]);
            if ($docId) $sideOpStatsRaw = $sideOpStatsRaw->where('doctor_id', $docId);
            $sideOpStatsRaw = $sideOpStatsRaw->get();

            if ($sideOpStatsRaw->count() > 0) {
                $doctorOpStats = $sideOpStatsRaw
                    ->groupBy(fn($s) => $s->doctor->name ?? '—')
                    ->map(fn($group) => $group->groupBy('operation_name_id')
                        ->map(fn($subGroup) => (object)[
                            'op'            => $subGroup->first()->operationName->name ?? '—',
                            'classification'=> $subGroup->first()->classification ?? ($subGroup->first()->operationName->classification ?? '—'),
                            'total'         => $subGroup->sum('quantity'),
                            'op_order'      => $subGroup->first()->operationName->display_order ?? 0,
                        ])->sortBy('op_order')->values()
                    );
            } else {
                $doctorOpStats = null;
            }

            return [
                'total_visits'         => $totalVisits,
                'total_surgeries'      => $totalSurgeries,
                'total_eye_tests'      => $totalEyeTests,
                'consultations'        => $consultations,
                'visits_by_doctor'     => $visitsByDoctor,
                'visits_by_gov'        => $visitsByGov,
                'visits_by_country'    => $visitsByCountry,
                'eye_tests_by_type'    => $eyeTestsByType,
                'surgeries_by_cat'     => $surgeriesByCat,
                'surgs_by_doctor'      => $surgsByDoctor,
                'surg_detail'          => $surgDetailByDoctor,
                'combined_ops'         => $combinedOps,
                'surgeries_by_gov'     => $surgeriesByGov,
                'surgeries_by_country' => $surgeriesByCountry,
                'doctor_op_stats'      => $doctorOpStats,
            ];
        };

        $sideA = $getSideStats(
            $r->get('doctor_id_a'),
            $r->get('start_date_a'),
            $r->get('end_date_a'),
            $r->get('op_class_a')
        );

        $sideB = $getSideStats(
            $r->get('doctor_id_b'),
            $r->get('start_date_b'),
            $r->get('end_date_b'),
            $r->get('op_class_b')
        );

        return response()->json([
            'side_a' => $sideA,
            'side_b' => $sideB,
        ]);
    }

    private function normalizeGovName($name)
    {
        $name = trim($name);
        $name = str_replace([' المقدسة', ' الأشرف'], '', $name);
        $name = str_replace(['أ', 'إ', 'آ'], 'ا', $name);
        $map = [
            'دهوك' => 'دهوك',
            'اربيل' => 'أربيل',
            'سليمانية' => 'السليمانية',
            'نينوى' => 'نينوى',
            'كركوك' => 'كركوك',
            'صلاح الدين' => 'صلاح الدين',
            'ديالى' => 'ديالى',
            'بغداد' => 'بغداد',
            'الانبار' => 'الأنبار',
            'بابل' => 'بابل',
            'كربلاء' => 'كربلاء',
            'واسط' => 'واسط',
            'النجف' => 'النجف',
            'القادسية' => 'القادسية',
            'ميسان' => 'ميسان',
            'ذي قار' => 'ذي قار',
            'المثنى' => 'المثنى',
            'البصرة' => 'البصرة',
        ];
        return $map[$name] ?? $map[trim($name)] ?? $name;
    }

    private function normalizeCountryName($name)
    {
        $name = trim($name);
        $name = str_replace(['أ', 'إ', 'آ'], 'ا', $name);
        $map = [
            'سعودية' => 'السعودية',
            'السعودية' => 'السعودية',
            'ايران' => 'إيران',
            'افغانستان' => 'أفغانستان',
            'البحرين' => 'البحرين',
            'باكستان' => 'باكستان',
            'سوريا' => 'سوريا',
            'لبنان' => 'لبنان',
            'مصر' => 'مصر',
            'الهند' => 'الهند',
            'نيجيريا' => 'نيجيريا',
            'اليمن' => 'اليمن',
            'نعمانيه' => 'عُمان'
        ];
        return $map[$name] ?? $map[trim($name)] ?? $name;
    }
}
