<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\TestType;
use App\Models\OperationName;
use App\Models\Sector;
use App\Models\ClinicUnit;
use App\Models\LabTestType;

class LookupController extends Controller
{
    // ========== DOCTORS ==========
    public function doctorsIndex()    { return response()->json(Doctor::all()); }
    public function doctorsStore(Request $r) {
        $r->validate(['name'=>'required|string|max:255']);
        return response()->json(Doctor::create(['name'=>$r->name]), 201);
    }
    public function doctorsUpdate(Request $r, Doctor $doctor) {
        $r->validate(['name'=>'required|string|max:255']);
        $doctor->update(['name'=>$r->name]);
        return response()->json($doctor);
    }
    public function doctorsDestroy(Doctor $doctor) {
        $doctor->delete(); return response()->json(['ok'=>true]);
    }

    // ========== COUNTRIES ==========
    public function countriesIndex()  { return response()->json(Country::all()); }
    public function countriesStore(Request $r) {
        $r->validate(['name'=>'required|string|max:255|unique:countries,name']);
        return response()->json(Country::create(['name'=>$r->name]), 201);
    }
    public function countriesDestroy(Country $country) {
        $country->delete(); return response()->json(['ok'=>true]);
    }

    // ========== GOVERNORATES ==========
    public function governoratesIndex()  { return response()->json(Governorate::all()); }
    public function governoratesStore(Request $r) {
        $r->validate(['name'=>'required|string|max:255|unique:governorates,name']);
        return response()->json(Governorate::create(['name'=>$r->name]), 201);
    }
    public function governoratesDestroy(Governorate $governorate) {
        $governorate->delete(); return response()->json(['ok'=>true]);
    }

    // ========== TEST TYPES ==========
    public function testTypesIndex()  { return response()->json(TestType::all()); }
    public function testTypesStore(Request $r) {
        $r->validate(['name'=>'required|string|max:255|unique:test_types,name']);
        return response()->json(TestType::create(['name'=>$r->name]), 201);
    }
    public function testTypesDestroy(TestType $testType) {
        $testType->delete(); return response()->json(['ok'=>true]);
    }

    // ========== OPERATION NAMES ==========
    public function operationNamesIndex()  { return response()->json(OperationName::all()); }
    public function operationNamesStore(Request $r) {
        $r->validate([
            'name'           => 'required|string|max:255',
            'classification' => 'required|in:صغرى,وسطى (حقن),وسطى (ليزر),كبرى,فوق الكبرى,خاصة',
        ]);
        return response()->json(OperationName::create(['name'=>$r->name,'classification'=>$r->classification]), 201);
    }
    public function operationNamesDestroy(OperationName $operationName) {
        $operationName->delete(); return response()->json(['ok'=>true]);
    }

    // ========== SECTORS ==========
    public function sectorsIndex()  { return response()->json(Sector::all()); }
    public function sectorsStore(Request $r) {
        $r->validate(['name'=>'required|string|max:255|unique:sectors,name']);
        return response()->json(Sector::create(['name'=>$r->name]), 201);
    }
    public function sectorsDestroy(Sector $sector) {
        $sector->delete(); return response()->json(['ok'=>true]);
    }

    // ========== CLINIC UNITS ==========
    public function clinicUnitsIndex()  { return response()->json(ClinicUnit::all()); }
    public function clinicUnitsStore(Request $r) {
        $r->validate(['name'=>'required|string|max:255|unique:clinic_units,name']);
        return response()->json(ClinicUnit::create(['name'=>$r->name]), 201);
    }
    public function clinicUnitsDestroy(ClinicUnit $clinicUnit) {
        $clinicUnit->delete(); return response()->json(['ok'=>true]);
    }

    // ========== LAB TEST TYPES ==========
    public function labTestTypesIndex()  { return response()->json(LabTestType::all()); }
    public function labTestTypesStore(Request $r) {
        $r->validate(['name'=>'required|string|max:255|unique:lab_test_types,name']);
        return response()->json(LabTestType::create(['name'=>$r->name]), 201);
    }
    public function labTestTypesDestroy(LabTestType $labTestType) {
        $labTestType->delete(); return response()->json(['ok'=>true]);
    }
}
