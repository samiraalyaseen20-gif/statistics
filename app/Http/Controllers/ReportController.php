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
        // Default to May 2026 as the active month of statistics data
        $start_date = $r->get('start_date', '2026-05-01');
        $end_date   = $r->get('end_date', '2026-05-31');

        // Extract month and year for backwards compatibility or display
        $time = strtotime($start_date);
        $year  = date('Y', $time);
        $month = date('m', $time);

        // جدول (1): الاستشاريات بالوحدة الطبية
        $consultations = Visit::with('clinicUnit')
            ->whereBetween('visit_date', [$start_date, $end_date])
            ->select('clinic_unit_id', DB::raw('count(*) as total'))
            ->groupBy('clinic_unit_id')
            ->get()->map(fn($v) => ['unit' => $v->clinicUnit->name ?? '—', 'total' => $v->total]);

        // جدول (2): مراجعي الاستشارية لكل طبيب
        $visitsByDoctor = Visit::with('doctor')
            ->whereBetween('visit_date', [$start_date, $end_date])
            ->select('doctor_id', DB::raw('count(*) as total'))
            ->groupBy('doctor_id')
            ->get()->map(fn($v) => ['doctor' => $v->doctor->name ?? '—', 'total' => $v->total]);

        // جدول (3): ديمغرافي داخل العراق (استشارية)
        $visitsByGov = Visit::with('governorate')
            ->whereBetween('visit_date', [$start_date, $end_date])
            ->whereNotNull('governorate_id')
            ->select('governorate_id', DB::raw('count(*) as total'))
            ->groupBy('governorate_id')
            ->get()->map(fn($v) => ['gov' => $v->governorate->name ?? '—', 'total' => $v->total]);

        // جدول (4): ديمغرافي خارج العراق (استشارية)
        $visitsByCountry = Visit::with('country')
            ->whereBetween('visit_date', [$start_date, $end_date])
            ->whereNotNull('country_id')
            ->select('country_id', DB::raw('count(*) as total'))
            ->groupBy('country_id')
            ->get()->map(fn($v) => ['country' => $v->country->name ?? '—', 'total' => $v->total]);

        // جدول (5): الفحوصات البصرية بالنوع
        $eyeTestsByType = EyeTest::with('testType')
            ->whereBetween('test_date', [$start_date, $end_date])
            ->select('test_type_id', DB::raw('count(*) as total'))
            ->groupBy('test_type_id')
            ->get()->map(fn($v) => ['type' => $v->testType->name ?? '—', 'total' => $v->total]);

        // جدول (6): مراجعو المختبر وتحاليله
        $labVisitCount = Visit::whereBetween('visit_date', [$start_date, $end_date])->count();
        $labTestsByType = LabTest::with('labTestType')
            ->whereBetween('test_date', [$start_date, $end_date])
            ->select('lab_test_type_id', DB::raw('count(*) as total'))
            ->groupBy('lab_test_type_id')
            ->get()->map(fn($v) => ['type' => $v->labTestType->name ?? '—', 'total' => $v->total]);

        // جدول (7): تصنيف العمليات × القطاع
        $surgeriesByCatSector = Surgery::with(['operationName','sector'])
            ->whereBetween('op_date', [$start_date, $end_date])
            ->join('operation_names','surgeries.operation_name_id','=','operation_names.id')
            ->join('sectors','surgeries.sector_id','=','sectors.id')
            ->select('operation_names.classification','sectors.name as sector', DB::raw('count(*) as total'))
            ->groupBy('operation_names.classification','sectors.name')
            ->get();

        // جدول (8): ديمغرافي داخل العراق (عمليات)
        $surgeriesByGov = Surgery::with('governorate')
            ->whereBetween('op_date', [$start_date, $end_date])
            ->whereNotNull('governorate_id')
            ->select('governorate_id', DB::raw('count(*) as total'))
            ->groupBy('governorate_id')
            ->get()->map(fn($v) => ['gov' => $v->governorate->name ?? '—', 'total' => $v->total]);

        // جدول (9): ديمغرافي خارج العراق (عمليات)
        $surgeriesByCountry = Surgery::with('country')
            ->whereBetween('op_date', [$start_date, $end_date])
            ->whereNotNull('country_id')
            ->select('country_id', DB::raw('count(*) as total'))
            ->groupBy('country_id')
            ->get()->map(fn($v) => ['country' => $v->country->name ?? '—', 'total' => $v->total]);

        // جدول (10): عمليات لكل طبيب بالتصنيف والقطاع
        $surgeriesByDoctorCatSector = Surgery::with(['doctor','operationName','sector'])
            ->whereBetween('op_date', [$start_date, $end_date])
            ->join('doctors','surgeries.doctor_id','=','doctors.id')
            ->join('operation_names','surgeries.operation_name_id','=','operation_names.id')
            ->join('sectors','surgeries.sector_id','=','sectors.id')
            ->select('doctors.name as doctor','operation_names.classification','sectors.name as sector', DB::raw('count(*) as total'))
            ->groupBy('doctors.name','operation_names.classification','sectors.name')
            ->get();

        // الملف الثاني: تفصيلي لكل طبيب (اسم العملية + العدد)
        $surgeryDetailByDoctor = Surgery::with(['doctor','operationName'])
            ->whereBetween('op_date', [$start_date, $end_date])
            ->join('doctors','surgeries.doctor_id','=','doctors.id')
            ->join('operation_names','surgeries.operation_name_id','=','operation_names.id')
            ->select('doctors.name as doctor','operation_names.name as op','operation_names.classification', DB::raw('count(*) as total'))
            ->groupBy('doctors.name','operation_names.name','operation_names.classification')
            ->get()->groupBy('doctor');

        // Totals
        $totalVisits    = Visit::whereBetween('visit_date', [$start_date, $end_date])->count();
        $totalEyeTests  = EyeTest::whereBetween('test_date', [$start_date, $end_date])->count();
        $totalSurgeries = Surgery::whereBetween('op_date', [$start_date, $end_date])->count();

        return view('main_screen', compact(
            'consultations','visitsByDoctor','visitsByGov','visitsByCountry',
            'eyeTestsByType','labVisitCount','labTestsByType',
            'surgeriesByCatSector','surgeriesByGov','surgeriesByCountry',
            'surgeriesByDoctorCatSector','surgeryDetailByDoctor',
            'totalVisits','totalEyeTests','totalSurgeries',
            'year','month','start_date','end_date'
        ));
    }
}
