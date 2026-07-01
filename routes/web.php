<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LookupController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\ReportController;

// ─── Auth ───
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

// ─── Protected ───
Route::middleware('auth')->group(function () {

    // Main SPA view (passes report data)
    Route::get('/', [ReportController::class, 'index']);
    Route::get('api/comparison-data', [ReportController::class, 'comparisonData']);

    // ── Lookups JSON API ──────────────────────────────────────────
    Route::prefix('api')->group(function () {

        // Doctors
        Route::get   ('doctors',               [LookupController::class, 'doctorsIndex']);
        Route::post  ('doctors',               [LookupController::class, 'doctorsStore']);
        Route::put   ('doctors/{doctor}',      [LookupController::class, 'doctorsUpdate']);
        Route::delete('doctors/{doctor}',      [LookupController::class, 'doctorsDestroy']);

        // Countries
        Route::get   ('countries',             [LookupController::class, 'countriesIndex']);
        Route::post  ('countries',             [LookupController::class, 'countriesStore']);
        Route::delete('countries/{country}',   [LookupController::class, 'countriesDestroy']);

        // Governorates
        Route::get   ('governorates',              [LookupController::class, 'governoratesIndex']);
        Route::post  ('governorates',              [LookupController::class, 'governoratesStore']);
        Route::delete('governorates/{governorate}',[LookupController::class, 'governoratesDestroy']);

        // Test Types
        Route::get   ('test-types',              [LookupController::class, 'testTypesIndex']);
        Route::post  ('test-types',              [LookupController::class, 'testTypesStore']);
        Route::delete('test-types/{testType}',   [LookupController::class, 'testTypesDestroy']);

        // Operation Names
        Route::get   ('operation-names',                  [LookupController::class, 'operationNamesIndex']);
        Route::post  ('operation-names',                  [LookupController::class, 'operationNamesStore']);
        Route::delete('operation-names/{operationName}',  [LookupController::class, 'operationNamesDestroy']);

        // Sectors
        Route::get   ('sectors',           [LookupController::class, 'sectorsIndex']);
        Route::post  ('sectors',           [LookupController::class, 'sectorsStore']);
        Route::delete('sectors/{sector}',  [LookupController::class, 'sectorsDestroy']);

        // Clinic Units
        Route::get   ('clinic-units',                [LookupController::class, 'clinicUnitsIndex']);
        Route::post  ('clinic-units',                [LookupController::class, 'clinicUnitsStore']);
        Route::delete('clinic-units/{clinicUnit}',   [LookupController::class, 'clinicUnitsDestroy']);

        // Lab Test Types
        Route::get   ('lab-test-types',               [LookupController::class, 'labTestTypesIndex']);
        Route::post  ('lab-test-types',               [LookupController::class, 'labTestTypesStore']);
        Route::delete('lab-test-types/{labTestType}', [LookupController::class, 'labTestTypesDestroy']);

        // ── Entry JSON API ────────────────────────────────────────
        Route::get   ('form-data',           [EntryController::class, 'formData']);

        // Visits
        Route::get   ('visits',              [EntryController::class, 'visitsIndex']);
        Route::post  ('visits',              [EntryController::class, 'visitsStore']);
        Route::delete('visits/{visit}',      [EntryController::class, 'visitsDestroy']);

        // Eye Tests
        Route::post  ('eye-tests',           [EntryController::class, 'eyeTestsStore']);
        Route::delete('eye-tests/{eyeTest}', [EntryController::class, 'eyeTestsDestroy']);

        // Lab Tests
        Route::post  ('lab-tests',           [EntryController::class, 'labTestsStore']);
        Route::delete('lab-tests/{labTest}', [EntryController::class, 'labTestsDestroy']);

        // Surgeries
        Route::get   ('surgeries',             [EntryController::class, 'surgeriesIndex']);
        Route::post  ('surgeries',             [EntryController::class, 'surgeriesStore']);
        Route::delete('surgeries/{surgery}',   [EntryController::class, 'surgeriesDestroy']);
    });
});
