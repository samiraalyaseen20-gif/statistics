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
use Illuminate\Support\Facades\Auth;

class LookupController extends Controller
{
    private function checkPermission() {
        $user = Auth::user();
        if ($user->role !== 'admin' && !$user->can_manage_lookups) {
            abort(response()->json(['error' => 'غير مصرح لك بالتعديل على الإدارة والتعريفات'], 403));
        }
    }

    // ========== DOCTORS ==========
    public function doctorsIndex()    { return response()->json(Doctor::orderBy('display_order', 'asc')->orderBy('id', 'asc')->get()); }
    public function doctorsStore(Request $r) {
        $this->checkPermission();
        $r->validate([
            'name'=>'required|string|max:255',
            'display_order'=>'nullable|integer'
        ]);
        return response()->json(Doctor::create(['name'=>$r->name, 'display_order'=>$r->get('display_order', 0)]), 201);
    }
    public function doctorsUpdate(Request $r, Doctor $doctor) {
        $this->checkPermission();
        $r->validate([
            'name'=>'required|string|max:255',
            'display_order'=>'nullable|integer'
        ]);
        $doctor->update(['name'=>$r->name, 'display_order'=>$r->get('display_order', 0)]);
        return response()->json($doctor);
    }
    public function doctorsDestroy(Doctor $doctor) {
        $this->checkPermission();
        $doctor->delete(); return response()->json(['ok'=>true]);
    }

    // ========== COUNTRIES ==========
    public function countriesIndex()  { return response()->json(Country::all()); }
    public function countriesStore(Request $r) {
        $this->checkPermission();
        $r->validate(['name'=>'required|string|max:255|unique:countries,name']);
        return response()->json(Country::create(['name'=>$r->name]), 201);
    }
    public function countriesDestroy(Country $country) {
        $this->checkPermission();
        $country->delete(); return response()->json(['ok'=>true]);
    }

    // ========== GOVERNORATES ==========
    public function governoratesIndex()  { return response()->json(Governorate::all()); }
    public function governoratesStore(Request $r) {
        $this->checkPermission();
        $r->validate(['name'=>'required|string|max:255|unique:governorates,name']);
        return response()->json(Governorate::create(['name'=>$r->name]), 201);
    }
    public function governoratesDestroy(Governorate $governorate) {
        $this->checkPermission();
        $governorate->delete(); return response()->json(['ok'=>true]);
    }

    // ========== TEST TYPES ==========
    public function testTypesIndex()  { return response()->json(TestType::all()); }
    public function testTypesStore(Request $r) {
        $this->checkPermission();
        $r->validate(['name'=>'required|string|max:255|unique:test_types,name']);
        return response()->json(TestType::create(['name'=>$r->name]), 201);
    }
    public function testTypesDestroy(TestType $testType) {
        $this->checkPermission();
        $testType->delete(); return response()->json(['ok'=>true]);
    }

    // ========== OPERATION NAMES ==========
    public function operationNamesIndex()  { return response()->json(OperationName::orderBy('display_order', 'asc')->orderBy('id', 'asc')->get()); }
    public function operationNamesStore(Request $r) {
        $this->checkPermission();
        $r->validate([
            'name'           => 'required|string|max:255',
            'classification' => 'required|in:صغرى,وسطى (حقن),وسطى (ليزر),كبرى,فوق الكبرى,خاصة',
            'display_order'  => 'nullable|integer'
        ]);
        return response()->json(OperationName::create([
            'name'=>$r->name,
            'classification'=>$r->classification,
            'display_order'=>$r->get('display_order', 0)
        ]), 201);
    }
    public function operationNamesUpdate(Request $r, OperationName $operationName) {
        $this->checkPermission();
        $r->validate([
            'name'           => 'required|string|max:255',
            'classification' => 'required|in:صغرى,وسطى (حقن),وسطى (ليزر),كبرى,فوق الكبرى,خاصة',
            'display_order'  => 'nullable|integer'
        ]);
        $operationName->update([
            'name'           => $r->name,
            'classification' => $r->classification,
            'display_order'  => $r->get('display_order', 0)
        ]);
        return response()->json($operationName);
    }
    public function operationNamesDestroy(OperationName $operationName) {
        $this->checkPermission();
        $operationName->delete(); return response()->json(['ok'=>true]);
    }

    // ========== SECTORS ==========
    public function sectorsIndex()  { return response()->json(Sector::all()); }
    public function sectorsStore(Request $r) {
        $this->checkPermission();
        $r->validate(['name'=>'required|string|max:255|unique:sectors,name']);
        return response()->json(Sector::create(['name'=>$r->name]), 201);
    }
    public function sectorsDestroy(Sector $sector) {
        $this->checkPermission();
        $sector->delete(); return response()->json(['ok'=>true]);
    }

    // ========== CLINIC UNITS ==========
    public function clinicUnitsIndex()  { return response()->json(ClinicUnit::all()); }
    public function clinicUnitsStore(Request $r) {
        $this->checkPermission();
        $r->validate(['name'=>'required|string|max:255|unique:clinic_units,name']);
        return response()->json(ClinicUnit::create(['name'=>$r->name]), 201);
    }
    public function clinicUnitsDestroy(ClinicUnit $clinicUnit) {
        $this->checkPermission();
        $clinicUnit->delete(); return response()->json(['ok'=>true]);
    }

    // ========== LAB TEST TYPES ==========
    public function labTestTypesIndex()  { return response()->json(LabTestType::all()); }
    public function labTestTypesStore(Request $r) {
        $this->checkPermission();
        $r->validate(['name'=>'required|string|max:255|unique:lab_test_types,name']);
        return response()->json(LabTestType::create(['name'=>$r->name]), 201);
    }
    public function labTestTypesDestroy(LabTestType $labTestType) {
        $this->checkPermission();
        $labTestType->delete(); return response()->json(['ok'=>true]);
    }
}
