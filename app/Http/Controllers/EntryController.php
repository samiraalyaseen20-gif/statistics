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
            ->latest('id')->paginate(20);
        return response()->json($q);
    }

    public function visitsStore(Request $r)
    {
        $r->validate([
            'patient_name'   => 'nullable|string|max:255',
            'doctor_id'      => 'required|exists:doctors,id',
            'clinic_unit_id' => 'required|exists:clinic_units,id',
            'governorate_id' => 'nullable|exists:governorates,id',
            'country_id'     => 'nullable|exists:countries,id',
            'status'         => 'required|in:مدفوع,غير مدفوع',
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
                'status'         => $r->status,
                'visit_date'     => $r->visit_date
            ]);
        }

        return response()->json($lastVisit->load(['doctor','clinicUnit','governorate','country']), 201);
    }

    public function visitsDestroy(Visit $visit)
    {
        $visit->delete(); return response()->json(['ok'=>true]);
    }

    // ========== EYE TESTS ==========
    public function eyeTestsStore(Request $r)
    {
        $r->validate([
            'test_type_id'  => 'required|exists:test_types,id',
            'test_date'     => 'required|date',
            'quantity'      => 'nullable|integer|min:1'
        ]);

        $qty = $r->get('quantity', 1);

        // Get default doctor and clinic unit to link the dummy visits
        $defaultDoc = Doctor::first();
        $defaultUnit = ClinicUnit::first();

        $lastTest = null;
        for ($i = 0; $i < $qty; $i++) {
            // Create a dummy visit
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
        // Delete the dummy visit associated if it has default text
        $visit = $eyeTest->visit;
        $eyeTest->delete();
        if ($visit && $visit->patient_name === 'قيد إحصائي فحص') {
            $visit->delete();
        }
        return response()->json(['ok'=>true]);
    }

    // ========== LAB TESTS ==========
    public function labTestsStore(Request $r)
    {
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
        $visit = $labTest->visit;
        $labTest->delete();
        if ($visit && $visit->patient_name === 'قيد إحصائي تحليل') {
            $visit->delete();
        }
        return response()->json(['ok'=>true]);
    }

    // ========== SURGERIES ==========
    public function surgeriesIndex(Request $r)
    {
        $q = Surgery::with(['doctor','operationName','sector','governorate','country'])
            ->when($r->month, fn($q,$m) => $q->whereYear('op_date', substr($m,0,4))->whereMonth('op_date', substr($m,5,2)))
            ->latest('id')->paginate(20);
        return response()->json($q);
    }

    public function surgeriesStore(Request $r)
    {
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
        $surgery->delete(); return response()->json(['ok'=>true]);
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
