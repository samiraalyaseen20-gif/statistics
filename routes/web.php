<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LookupController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

// ─── Auth ───
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

// ─── Protected ───
Route::middleware('auth')->group(function () {

    // Main SPA view
    Route::get('/', [ReportController::class, 'index']);
    Route::get('api/comparison-data', [ReportController::class, 'comparisonData']);

    // ── JSON API ──────────────────────────────────────────
    Route::prefix('api')->group(function () {

        // Doctors
        Route::get   ('doctors',               [LookupController::class, 'doctorsIndex']);
        Route::post  ('doctors',               [LookupController::class, 'doctorsStore']);
        Route::put   ('doctors/{doctor}',      [LookupController::class, 'doctorsUpdate']);
        Route::delete('doctors/{doctor}',      [LookupController::class, 'doctorsDestroy']);

        // Countries
        Route::get   ('countries',             [LookupController::class, 'countriesIndex']);
        Route::post  ('countries',             [LookupController::class, 'countriesStore']);
        Route::put   ('countries/{country}',   [LookupController::class, 'countriesUpdate']);
        Route::delete('countries/{country}',   [LookupController::class, 'countriesDestroy']);

        // Governorates
        Route::get   ('governorates',              [LookupController::class, 'governoratesIndex']);
        Route::post  ('governorates',              [LookupController::class, 'governoratesStore']);
        Route::put   ('governorates/{governorate}',[LookupController::class, 'governoratesUpdate']);
        Route::delete('governorates/{governorate}',[LookupController::class, 'governoratesDestroy']);

        // Test Types
        Route::get   ('test-types',              [LookupController::class, 'testTypesIndex']);
        Route::post  ('test-types',              [LookupController::class, 'testTypesStore']);
        Route::put   ('test-types/{testType}',   [LookupController::class, 'testTypesUpdate']);
        Route::delete('test-types/{testType}',   [LookupController::class, 'testTypesDestroy']);

        // Operation Names
        Route::get   ('operation-names',                  [LookupController::class, 'operationNamesIndex']);
        Route::post  ('operation-names',                  [LookupController::class, 'operationNamesStore']);
        Route::put   ('operation-names/{operationName}',  [LookupController::class, 'operationNamesUpdate']);
        Route::delete('operation-names/{operationName}',  [LookupController::class, 'operationNamesDestroy']);

        // Classifications
        Route::get   ('classifications',                    [LookupController::class, 'classificationsIndex']);
        Route::post  ('classifications',                    [LookupController::class, 'classificationsStore']);
        Route::put   ('classifications/{classification}',   [LookupController::class, 'classificationsUpdate']);
        Route::delete('classifications/{classification}',   [LookupController::class, 'classificationsDestroy']);

        // Sectors
        Route::get   ('sectors',           [LookupController::class, 'sectorsIndex']);
        Route::post  ('sectors',           [LookupController::class, 'sectorsStore']);
        Route::put   ('sectors/{sector}',  [LookupController::class, 'sectorsUpdate']);
        Route::delete('sectors/{sector}',  [LookupController::class, 'sectorsDestroy']);

        // Clinic Units
        Route::get   ('clinic-units',                [LookupController::class, 'clinicUnitsIndex']);
        Route::post  ('clinic-units',                [LookupController::class, 'clinicUnitsStore']);
        Route::put   ('clinic-units/{clinicUnit}',   [LookupController::class, 'clinicUnitsUpdate']);
        Route::delete('clinic-units/{clinicUnit}',   [LookupController::class, 'clinicUnitsDestroy']);

        // Lab Test Types
        Route::get   ('lab-test-types',               [LookupController::class, 'labTestTypesIndex']);
        Route::post  ('lab-test-types',               [LookupController::class, 'labTestTypesStore']);
        Route::put   ('lab-test-types/{labTestType}',[LookupController::class, 'labTestTypesUpdate']);
        Route::delete('lab-test-types/{labTestType}', [LookupController::class, 'labTestTypesDestroy']);

        // Entry API
        Route::get   ('form-data',           [EntryController::class, 'formData']);
        Route::post  ('entry/clear',         [EntryController::class, 'clearData']);

        // Visits
        Route::get   ('visits',              [EntryController::class, 'visitsIndex']);
        Route::post  ('visits',              [EntryController::class, 'visitsStore']);
        Route::put   ('visits/{visit}',      [EntryController::class, 'visitsUpdate']);
        Route::delete('visits/{visit}',      [EntryController::class, 'visitsDestroy']);

        // Eye Tests
        Route::get   ('eye-tests',           [EntryController::class, 'eyeTestsIndex']);
        Route::post  ('eye-tests',           [EntryController::class, 'eyeTestsStore']);
        Route::put   ('eye-tests/{eyeTest}', [EntryController::class, 'eyeTestsUpdate']);
        Route::delete('eye-tests/{eyeTest}', [EntryController::class, 'eyeTestsDestroy']);

        // Lab Tests
        Route::get   ('lab-tests',           [EntryController::class, 'labTestsIndex']);
        Route::post  ('lab-tests',           [EntryController::class, 'labTestsStore']);
        Route::put   ('lab-tests/{labTest}', [EntryController::class, 'labTestsUpdate']);
        Route::delete('lab-tests/{labTest}', [EntryController::class, 'labTestsDestroy']);

        // Surgeries
        Route::get   ('surgeries',             [EntryController::class, 'surgeriesIndex']);
        Route::post  ('surgeries',             [EntryController::class, 'surgeriesStore']);
        Route::put   ('surgeries/{surgery}',   [EntryController::class, 'surgeriesUpdate']);
        Route::delete('surgeries/{surgery}',   [EntryController::class, 'surgeriesDestroy']);

        // Doctor Operation Stats (per-doctor detailed operations)
        Route::get   ('doctor-op-stats',       [EntryController::class, 'doctorOpStatsIndex']);
        Route::post  ('doctor-op-stats/save',  [EntryController::class, 'doctorOpStatsSave']);
        Route::post  ('doctor-op-stats/clear', [EntryController::class, 'doctorOpStatsClear']);

        // Doctor Surgery Stats (إجمالي العمليات المنفذة لكل طبيب — جدول مستقل تماماً)
        Route::get   ('doctor-surgery-stats',       [EntryController::class, 'doctorSurgeryStatsIndex']);
        Route::post  ('doctor-surgery-stats/save',  [EntryController::class, 'doctorSurgeryStatsSave']);
        Route::post  ('doctor-surgery-stats/clear', [EntryController::class, 'doctorSurgeryStatsClear']);

        // Diagnostic route for server database inspection
        Route::get('diagnose-surgeries', function (\Illuminate\Http\Request $request) {
            $month = $request->get('month', now()->format('Y-m'));
            $start = $month . '-01';
            $end = \Carbon\Carbon::parse($start)->endOfMonth()->toDateString();
            
            $defaultDoc = \App\Models\Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
            $defaultOp  = \App\Models\OperationName::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
            
            $allSurgs = \App\Models\Surgery::whereBetween('op_date', [$start, $end])
                ->whereNull('governorate_id')
                ->whereNull('country_id')
                ->get()
                ->map(function ($s) {
                    return [
                        'id' => $s->id,
                        'patient' => $s->patient_name,
                        'doctor' => $s->doctor?->name,
                        'doctor_id' => $s->doctor_id,
                        'operation' => $s->operationName?->name,
                        'operation_id' => $s->operation_name_id,
                        'sector' => $s->sector?->name,
                        'sector_id' => $s->sector_id,
                        'classification' => $s->classification,
                        'op_date' => $s->op_date,
                    ];
                });
                
            return response()->json([
                'month' => $month,
                'default_doctor' => [
                    'id' => $defaultDoc ? $defaultDoc->id : null,
                    'name' => $defaultDoc ? $defaultDoc->name : null,
                ],
                'default_operation' => [
                    'id' => $defaultOp ? $defaultOp->id : null,
                    'name' => $defaultOp ? $defaultOp->name : null,
                ],
                'all_surgeries_count' => $allSurgs->count(),
                'all_surgeries_in_month' => $allSurgs
            ]);
        });

        // Users & Permissions Management
        Route::get   ('users',                 [UserController::class, 'index']);
        Route::post  ('users',                 [UserController::class, 'store']);
        Route::put   ('users/{user}/permissions', [UserController::class, 'updatePermissions']);
        Route::delete('users/{user}',          [UserController::class, 'destroy']);

        // Settings
        Route::post  ('settings',              [\App\Http\Controllers\SettingController::class, 'update']);
        Route::get   ('settings',              [\App\Http\Controllers\SettingController::class, 'index']);
    });
});
