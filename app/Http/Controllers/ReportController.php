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
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $r)
    {
        // 1. Date Range Filters (Defaults to May 2026)
        $start_date = $r->get('start_date', '2026-05-01');
        $end_date   = $r->get('end_date', '2026-05-31');

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

        // 3. Build decoupled filtered base queries to prevent filter conflicts
        // a. Visits by Doctor & Clinic Unit
        $visitsDocQuery = Visit::whereBetween('visit_date', [$start_date, $end_date])
            ->whereNull('governorate_id')
            ->whereNull('country_id');
        if ($doctor_id)      $visitsDocQuery->where('doctor_id', $doctor_id);
        if ($clinic_unit_id) $visitsDocQuery->where('clinic_unit_id', $clinic_unit_id);

        // b. Visits by Governorate & Country (Demographics)
        $visitsGeoQuery = Visit::whereBetween('visit_date', [$start_date, $end_date])
            ->where(function($q) {
                $q->whereNotNull('governorate_id')->orWhereNotNull('country_id');
            });
        if ($governorate_id) $visitsGeoQuery->where('governorate_id', $governorate_id);
        if ($country_id)     $visitsGeoQuery->where('country_id', $country_id);

        // c. Surgeries by Doctor
        $surgeriesDocQuery = Surgery::whereBetween('op_date', [$start_date, $end_date]);
        if ($doctor_id)      $surgeriesDocQuery->where('doctor_id', $doctor_id);
        if ($governorate_id) $surgeriesDocQuery->where('governorate_id', $governorate_id);
        if ($country_id)     $surgeriesDocQuery->where('country_id', $country_id);

        // d. Surgeries by Operation Category & Sector
        $surgeriesCatQuery = Surgery::whereBetween('op_date', [$start_date, $end_date]);
        if ($sector_id)      $surgeriesCatQuery->where('sector_id', $sector_id);
        if ($governorate_id) $surgeriesCatQuery->where('governorate_id', $governorate_id);
        if ($country_id)     $surgeriesCatQuery->where('country_id', $country_id);

        // e. Tests (Ignore doctor/clinic filters as they are entered as aggregates)
        $eyeTestsQuery = EyeTest::whereBetween('test_date', [$start_date, $end_date]);
        $labTestsQuery = LabTest::whereBetween('test_date', [$start_date, $end_date]);

        // 4. Fetch statistics using clones of the base queries

        // جدول (1): الاستشاريات بالوحدة الطبية
        $consultations = (clone $visitsDocQuery)
            ->select('clinic_unit_id', DB::raw('count(*) as total'))
            ->groupBy('clinic_unit_id')
            ->get()->map(fn($v) => ['unit' => $v->clinicUnit->name ?? '—', 'total' => $v->total]);

        // جدول (2): مراجعي الاستشارية لكل طبيب
        $visitsByDoctor = (clone $visitsDocQuery)
            ->join('doctors', 'visits.doctor_id', '=', 'doctors.id')
            ->select('visits.doctor_id', 'doctors.name as doctor', 'doctors.display_order', DB::raw('count(*) as total'))
            ->groupBy('visits.doctor_id', 'doctors.name', 'doctors.display_order')
            ->orderBy('doctors.display_order', 'asc')
            ->orderBy('doctors.name', 'asc')
            ->get()->map(fn($v) => ['doctor' => $v->doctor ?? '—', 'total' => $v->total]);

        // جدول (3): ديمغرافي داخل العراق (استشارية)
        $visitsByGov = (clone $visitsGeoQuery)
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
        $visitsByCountry = (clone $visitsGeoQuery)
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
        $labVisitCount = (clone $visitsDocQuery)->count();
        $labTestsByType = (clone $labTestsQuery)
            ->select('lab_test_type_id', DB::raw('count(*) as total'))
            ->groupBy('lab_test_type_id')
            ->get()->map(fn($v) => ['type' => $v->labTestType->name ?? '—', 'total' => $v->total]);

        // جدول (7): تصنيف العمليات × القطاع
        $surgeriesByCatSector = (clone $surgeriesCatQuery)
            ->join('operation_names','surgeries.operation_name_id','=','operation_names.id')
            ->join('sectors','surgeries.sector_id','=','sectors.id')
            ->select('operation_names.classification','sectors.name as sector', DB::raw('count(*) as total'))
            ->groupBy('operation_names.classification','sectors.name')
            ->get();

        // جدول (8): ديمغرافي داخل العراق (عمليات)
        $surgeriesByGov = (clone $surgeriesCatQuery)
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
        $surgeriesByCountry = (clone $surgeriesCatQuery)
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

        // جدول (10): عمليات لكل طبيب بالتصنيف والقطاع
        $surgeriesByDoctorCatSector = (clone $surgeriesDocQuery)
            ->join('doctors','surgeries.doctor_id','=','doctors.id')
            ->join('operation_names','surgeries.operation_name_id','=','operation_names.id')
            ->join('sectors','surgeries.sector_id','=','sectors.id')
            ->select('doctors.name as doctor','doctors.display_order','operation_names.classification','sectors.name as sector', DB::raw('count(*) as total'))
            ->groupBy('doctors.name','doctors.display_order','operation_names.classification','sectors.name')
            ->orderBy('doctors.display_order', 'asc')
            ->orderBy('doctors.name', 'asc')
            ->get();

        // الملف الثاني: تفصيلي لكل طبيب (اسم العملية + العدد)
        $surgeryDetailByDoctor = (clone $surgeriesDocQuery)
            ->join('doctors','surgeries.doctor_id','=','doctors.id')
            ->join('operation_names','surgeries.operation_name_id','=','operation_names.id')
            ->select('doctors.name as doctor','doctors.display_order as doc_order','operation_names.name as op','operation_names.display_order as op_order','operation_names.classification', DB::raw('count(*) as total'))
            ->groupBy('doctors.name','doctors.display_order','operation_names.name','operation_names.display_order','operation_names.classification')
            ->orderBy('doctors.display_order', 'asc')
            ->orderBy('operation_names.display_order', 'asc')
            ->get()->groupBy('doctor');

        // Totals
        $totalVisits    = (clone $visitsDocQuery)->count();
        $totalEyeTests  = (clone $eyeTestsQuery)->count();
        $totalSurgeries = (clone $surgeriesDocQuery)->count();

        $filterDoctors      = Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->get();
        $filterClinicUnits  = ClinicUnit::orderBy('name')->get();
        $filterSectors      = Sector::orderBy('name')->get();
        $filterGovernorates = Governorate::orderBy('name')->get();
        $filterCountries    = Country::orderBy('name')->get();
        $filterTestTypes    = \App\Models\TestType::orderBy('name')->get();
        $filterLabTestTypes = \App\Models\LabTestType::orderBy('name')->get();
        $filterOperations   = OperationName::orderBy('display_order', 'asc')->orderBy('name', 'asc')->get();

        return view('main_screen', compact(
            'consultations','visitsByDoctor','visitsByGov','visitsByCountry',
            'eyeTestsByType','labVisitCount','labTestsByType',
            'surgeriesByCatSector','surgeriesByGov','surgeriesByCountry',
            'surgeriesByDoctorCatSector','surgeryDetailByDoctor',
            'totalVisits','totalEyeTests','totalSurgeries',
            'year','month','start_date','end_date',
            'doctor_id','clinic_unit_id','sector_id','governorate_id','country_id',
            'filterDoctors','filterClinicUnits','filterSectors','filterGovernorates','filterCountries',
            'filterTestTypes','filterLabTestTypes', 'filterOperations'
        ));
    }

    public function comparisonData(Request $r)
    {
        $getSideStats = function($docId, $startDate, $endDate, $opClass = null) {
            $startDate = $startDate ?: '2026-05-01';
            $endDate   = $endDate ?: '2026-05-31';

            $visitsQuery = Visit::whereBetween('visit_date', [$startDate, $endDate])
                ->whereNull('governorate_id')
                ->whereNull('country_id');
            if ($docId) $visitsQuery->where('doctor_id', $docId);

            $geoQuery = Visit::whereBetween('visit_date', [$startDate, $endDate])
                ->where(function($q) {
                    $q->whereNotNull('governorate_id')->orWhereNotNull('country_id');
                });

            $surgeriesQuery = Surgery::whereBetween('op_date', [$startDate, $endDate]);
            if ($docId) $surgeriesQuery->where('doctor_id', $docId);
            if ($opClass) {
                $surgeriesQuery->join('operation_names as op_filter', 'surgeries.operation_name_id', '=', 'op_filter.id')
                    ->where('op_filter.classification', $opClass);
            }

            // Totals
            $totalVisits    = (clone $visitsQuery)->count();
            $totalSurgeries = (clone $surgeriesQuery)->count();

            // فحوصات بصرية — مستقلة لا تتأثر بالطبيب أو تصنيف العملية
            $eyeTestsQuery = \App\Models\EyeTest::whereBetween('test_date', [$startDate, $endDate]);
            $totalEyeTests = (clone $eyeTestsQuery)->count();
            $eyeTestsByType = (clone $eyeTestsQuery)
                ->select('test_type_id', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                ->groupBy('test_type_id')
                ->get()->map(fn($v) => ['type' => $v->testType->name ?? '—', 'total' => $v->total]);

            // جدول 1: الاستشاريات بالوحدة الطبية
            $consultations = (clone $visitsQuery)
                ->select('clinic_unit_id', DB::raw('count(*) as total'))
                ->groupBy('clinic_unit_id')
                ->get()->map(fn($v) => ['unit' => $v->clinicUnit->name ?? '—', 'total' => $v->total]);

            // جدول 2: مراجعو كل طبيب
            $visitsByDoctor = (clone $visitsQuery)
                ->join('doctors', 'visits.doctor_id', '=', 'doctors.id')
                ->select('visits.doctor_id', 'doctors.name as doctor', 'doctors.display_order', DB::raw('count(*) as total'))
                ->groupBy('visits.doctor_id', 'doctors.name', 'doctors.display_order')
                ->orderBy('doctors.display_order', 'asc')
                ->orderBy('doctors.name', 'asc')
                ->get()->map(fn($v) => ['doctor' => $v->doctor ?? '—', 'total' => $v->total]);

            // جدول 3: داخل العراق
            $visitsByGov = (clone $geoQuery)
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
            $visitsByCountry = (clone $geoQuery)
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
            $surgeriesByCat = (clone $surgeriesQuery)
                ->join('operation_names','surgeries.operation_name_id','=','operation_names.id')
                ->select('operation_names.classification', DB::raw('count(*) as total'))
                ->groupBy('operation_names.classification')
                ->get()->map(fn($v) => ['classification' => $v->classification, 'total' => $v->total]);

            // جدول 10: عمليات كل طبيب (الإجمالي)
            $surgsByDoctor = (clone $surgeriesQuery)
                ->join('doctors','surgeries.doctor_id','=','doctors.id')
                ->select('doctors.name as doctor', 'doctors.display_order', DB::raw('count(*) as total'))
                ->groupBy('doctors.name', 'doctors.display_order')
                ->orderBy('doctors.display_order', 'asc')
                ->orderBy('doctors.name', 'asc')
                ->get()->map(fn($v) => ['doctor' => $v->doctor, 'total' => $v->total]);

            // تفصيلي: اسم العملية لكل طبيب
            $surgDetailByDoctor = (clone $surgeriesQuery)
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

            return [
                'total_visits'      => $totalVisits,
                'total_surgeries'   => $totalSurgeries,
                'total_eye_tests'   => $totalEyeTests,
                'consultations'     => $consultations,
                'visits_by_doctor'  => $visitsByDoctor,
                'visits_by_gov'     => $visitsByGov,
                'visits_by_country' => $visitsByCountry,
                'eye_tests_by_type' => $eyeTestsByType,
                'surgeries_by_cat'  => $surgeriesByCat,
                'surgs_by_doctor'   => $surgsByDoctor,
                'surg_detail'       => $surgDetailByDoctor,
                'combined_ops'      => $combinedOps,
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
