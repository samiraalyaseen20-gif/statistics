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

        // 3. Build filtered base queries
        $visitsQuery = Visit::whereBetween('visit_date', [$start_date, $end_date]);
        if ($doctor_id)      $visitsQuery->where('doctor_id', $doctor_id);
        if ($clinic_unit_id) $visitsQuery->where('clinic_unit_id', $clinic_unit_id);
        if ($governorate_id) $visitsQuery->where('governorate_id', $governorate_id);
        if ($country_id)     $visitsQuery->where('country_id', $country_id);

        $surgeriesQuery = Surgery::whereBetween('op_date', [$start_date, $end_date]);
        if ($doctor_id)      $surgeriesQuery->where('doctor_id', $doctor_id);
        if ($sector_id)      $surgeriesQuery->where('sector_id', $sector_id);
        if ($governorate_id) $surgeriesQuery->where('governorate_id', $governorate_id);
        if ($country_id)     $surgeriesQuery->where('country_id', $country_id);

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
        $consultations = (clone $visitsQuery)
            ->select('clinic_unit_id', DB::raw('count(*) as total'))
            ->groupBy('clinic_unit_id')
            ->get()->map(fn($v) => ['unit' => $v->clinicUnit->name ?? '—', 'total' => $v->total]);

        // جدول (2): مراجعي الاستشارية لكل طبيب
        $visitsByDoctor = (clone $visitsQuery)
            ->select('doctor_id', DB::raw('count(*) as total'))
            ->groupBy('doctor_id')
            ->get()->map(fn($v) => ['doctor' => $v->doctor->name ?? '—', 'total' => $v->total]);

        // جدول (3): ديمغرافي داخل العراق (استشارية)
        $visitsByGov = (clone $visitsQuery)
            ->whereNotNull('governorate_id')
            ->select('governorate_id', DB::raw('count(*) as total'))
            ->groupBy('governorate_id')
            ->get()->map(fn($v) => ['gov' => $v->governorate->name ?? '—', 'total' => $v->total]);

        // جدول (4): ديمغرافي خارج العراق (استشارية)
        $visitsByCountry = (clone $visitsQuery)
            ->whereNotNull('country_id')
            ->select('country_id', DB::raw('count(*) as total'))
            ->groupBy('country_id')
            ->get()->map(fn($v) => ['country' => $v->country->name ?? '—', 'total' => $v->total]);

        // جدول (5): الفحوصات البصرية بالنوع
        $eyeTestsByType = (clone $eyeTestsQuery)
            ->select('test_type_id', DB::raw('count(*) as total'))
            ->groupBy('test_type_id')
            ->get()->map(fn($v) => ['type' => $v->testType->name ?? '—', 'total' => $v->total]);

        // جدول (6): مراجعو المختبر وتحاليله
        $labVisitCount = (clone $visitsQuery)->count();
        $labTestsByType = (clone $labTestsQuery)
            ->select('lab_test_type_id', DB::raw('count(*) as total'))
            ->groupBy('lab_test_type_id')
            ->get()->map(fn($v) => ['type' => $v->labTestType->name ?? '—', 'total' => $v->total]);

        // جدول (7): تصنيف العمليات × القطاع
        $surgeriesByCatSector = (clone $surgeriesQuery)
            ->join('operation_names','surgeries.operation_name_id','=','operation_names.id')
            ->join('sectors','surgeries.sector_id','=','sectors.id')
            ->select('operation_names.classification','sectors.name as sector', DB::raw('count(*) as total'))
            ->groupBy('operation_names.classification','sectors.name')
            ->get();

        // جدول (8): ديمغرافي داخل العراق (عمليات)
        $surgeriesByGov = (clone $surgeriesQuery)
            ->whereNotNull('governorate_id')
            ->select('governorate_id', DB::raw('count(*) as total'))
            ->groupBy('governorate_id')
            ->get()->map(fn($v) => ['gov' => $v->governorate->name ?? '—', 'total' => $v->total]);

        // جدول (9): ديمغرافي خارج العراق (عمليات)
        $surgeriesByCountry = (clone $surgeriesQuery)
            ->whereNotNull('country_id')
            ->select('country_id', DB::raw('count(*) as total'))
            ->groupBy('country_id')
            ->get()->map(fn($v) => ['country' => $v->country->name ?? '—', 'total' => $v->total]);

        // جدول (10): عمليات لكل طبيب بالتصنيف والقطاع
        $surgeriesByDoctorCatSector = (clone $surgeriesQuery)
            ->join('doctors','surgeries.doctor_id','=','doctors.id')
            ->join('operation_names','surgeries.operation_name_id','=','operation_names.id')
            ->join('sectors','surgeries.sector_id','=','sectors.id')
            ->select('doctors.name as doctor','operation_names.classification','sectors.name as sector', DB::raw('count(*) as total'))
            ->groupBy('doctors.name','operation_names.classification','sectors.name')
            ->get();

        // الملف الثاني: تفصيلي لكل طبيب (اسم العملية + العدد)
        $surgeryDetailByDoctor = (clone $surgeriesQuery)
            ->join('doctors','surgeries.doctor_id','=','doctors.id')
            ->join('operation_names','surgeries.operation_name_id','=','operation_names.id')
            ->select('doctors.name as doctor','operation_names.name as op','operation_names.classification', DB::raw('count(*) as total'))
            ->groupBy('doctors.name','operation_names.name','operation_names.classification')
            ->get()->groupBy('doctor');

        // Totals
        $totalVisits    = (clone $visitsQuery)->count();
        $totalEyeTests  = (clone $eyeTestsQuery)->count();
        $totalSurgeries = (clone $surgeriesQuery)->count();

        // Fetch lookup lists for page filters dropdowns
        $filterDoctors      = Doctor::orderBy('name')->get();
        $filterClinicUnits  = ClinicUnit::orderBy('name')->get();
        $filterSectors      = Sector::orderBy('name')->get();
        $filterGovernorates = Governorate::orderBy('name')->get();
        $filterCountries    = Country::orderBy('name')->get();

        return view('main_screen', compact(
            'consultations','visitsByDoctor','visitsByGov','visitsByCountry',
            'eyeTestsByType','labVisitCount','labTestsByType',
            'surgeriesByCatSector','surgeriesByGov','surgeriesByCountry',
            'surgeriesByDoctorCatSector','surgeryDetailByDoctor',
            'totalVisits','totalEyeTests','totalSurgeries',
            'year','month','start_date','end_date',
            'doctor_id','clinic_unit_id','sector_id','governorate_id','country_id',
            'filterDoctors','filterClinicUnits','filterSectors','filterGovernorates','filterCountries'
        ));
    }
}
