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

class EntryController extends Controller
{
    // ========== VISITS ==========
    public function visitsIndex(Request $r)
    {
        $q = Visit::with(['doctor','clinicUnit','governorate','country'])
            ->when($r->month, fn($q,$m) => $q->whereYear('visit_date', substr($m,0,4))->whereMonth('visit_date', substr($m,5,2)))
            ->latest('visit_date')->paginate(20);
        return response()->json($q);
    }

    public function visitsStore(Request $r)
    {
        $r->validate([
            'patient_name'   => 'required|string|max:255',
            'doctor_id'      => 'required|exists:doctors,id',
            'clinic_unit_id' => 'required|exists:clinic_units,id',
            'governorate_id' => 'nullable|exists:governorates,id',
            'country_id'     => 'nullable|exists:countries,id',
            'status'         => 'required|in:مدفوع,غير مدفوع',
            'visit_date'     => 'required|date',
        ]);
        $visit = Visit::create($r->only(['patient_name','doctor_id','clinic_unit_id','governorate_id','country_id','status','visit_date']));
        return response()->json($visit->load(['doctor','clinicUnit','governorate','country']), 201);
    }

    public function visitsDestroy(Visit $visit)
    {
        $visit->delete(); return response()->json(['ok'=>true]);
    }

    // ========== EYE TESTS ==========
    public function eyeTestsStore(Request $r)
    {
        $r->validate([
            'visit_id'      => 'required|exists:visits,id',
            'test_type_id'  => 'required|exists:test_types,id',
            'test_date'     => 'required|date',
        ]);
        $t = EyeTest::create($r->only(['visit_id','test_type_id','test_date']));
        return response()->json($t->load('testType'), 201);
    }

    public function eyeTestsDestroy(EyeTest $eyeTest)
    {
        $eyeTest->delete(); return response()->json(['ok'=>true]);
    }

    // ========== LAB TESTS ==========
    public function labTestsStore(Request $r)
    {
        $r->validate([
            'visit_id'         => 'required|exists:visits,id',
            'lab_test_type_id' => 'required|exists:lab_test_types,id',
            'test_date'        => 'required|date',
        ]);
        $t = LabTest::create($r->only(['visit_id','lab_test_type_id','test_date']));
        return response()->json($t->load('labTestType'), 201);
    }

    public function labTestsDestroy(LabTest $labTest)
    {
        $labTest->delete(); return response()->json(['ok'=>true]);
    }

    // ========== SURGERIES ==========
    public function surgeriesIndex(Request $r)
    {
        $q = Surgery::with(['doctor','operationName','sector','governorate','country'])
            ->when($r->month, fn($q,$m) => $q->whereYear('op_date', substr($m,0,4))->whereMonth('op_date', substr($m,5,2)))
            ->latest('op_date')->paginate(20);
        return response()->json($q);
    }

    public function surgeriesStore(Request $r)
    {
        $r->validate([
            'patient_name'      => 'required|string|max:255',
            'doctor_id'         => 'required|exists:doctors,id',
            'operation_name_id' => 'required|exists:operation_names,id',
            'sector_id'         => 'required|exists:sectors,id',
            'governorate_id'    => 'nullable|exists:governorates,id',
            'country_id'        => 'nullable|exists:countries,id',
            'op_date'           => 'required|date',
        ]);
        $s = Surgery::create($r->only(['patient_name','doctor_id','operation_name_id','sector_id','governorate_id','country_id','op_date']));
        return response()->json($s->load(['doctor','operationName','sector','governorate','country']), 201);
    }

    public function surgeriesDestroy(Surgery $surgery)
    {
        $surgery->delete(); return response()->json(['ok'=>true]);
    }

    // ========== FORM DATA (for dropdowns) ==========
    public function formData()
    {
        return response()->json([
            'doctors'        => Doctor::all(['id','name','fee']),
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
