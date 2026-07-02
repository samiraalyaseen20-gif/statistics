<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;
use App\Models\Governorate;
use App\Models\Country;
use App\Models\TestType;
use App\Models\LabTestType;
use App\Models\OperationName;
use App\Models\Sector;
use App\Models\ClinicUnit;

class WordDataSeeder extends Seeder
{
    private function normalizeDoctorName($name) {
        $name = trim($name);
        // إزالة المسافات المتعددة لتصبح مسافة واحدة
        $name = preg_replace('/\s+/', ' ', $name);
        // إضافة مسافة بعد "د." إذا لم تكن موجودة
        if (str_starts_with($name, 'د.') && !str_starts_with($name, 'د. ')) {
            $name = str_replace('د.', 'د. ', $name);
        }
        // توحيد عبد الكندي والكندي، نعمة ونعمه الخ
        $name = str_replace('عبد الكندي', 'الكندي', $name);
        $name = str_replace('نعمة', 'نعمه', $name);
        return $name;
    }

    public function run()
    {
        $jsonPath = database_path('data/extracted_statistics.json');
        if (!file_exists($jsonPath)) {
            $this->command->error("JSON file not found at: {$jsonPath}");
            return;
        }

        $data = json_decode(file_get_contents($jsonPath), true);
        
        $this->command->info("Truncating old tables...");
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate Lookups
        DB::table('doctors')->truncate();
        DB::table('governorates')->truncate();
        DB::table('countries')->truncate();
        DB::table('test_types')->truncate();
        DB::table('lab_test_types')->truncate();
        DB::table('operation_names')->truncate();
        
        // Truncate Transactions
        DB::table('visits')->truncate();
        DB::table('surgeries')->truncate();
        DB::table('eye_tests')->truncate();
        DB::table('lab_tests')->truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info("Extracting unique lookups from JSON...");
        
        $uniqueDoctors = [];
        $uniqueGovs = [];
        $uniqueCountries = [];
        $uniqueEyeTests = [];
        $uniqueLabTests = [];
        $uniqueOps = [];
        
        foreach ($data as $month => $monthData) {
            $visits = $monthData['visits'];
            
            foreach ($visits['doctors_visits'] as $v) {
                $doc = $this->normalizeDoctorName($v['doctor']);
                if ($doc && !str_contains($doc, 'المجموع') && !in_array($doc, $uniqueDoctors)) $uniqueDoctors[] = $doc;
            }
            // Add doctors from surgeries too!
            $surgeriesSource = isset($monthData['surgeries_by_doc']) ? $monthData['surgeries_by_doc'] : [];
            foreach ($surgeriesSource as $s) {
                $doc = $this->normalizeDoctorName($s['doctor'] ?? '');
                if ($doc && !str_contains($doc, 'المجموع') && !in_array($doc, $uniqueDoctors)) $uniqueDoctors[] = $doc;
            }
            
            foreach ($visits['governorates_visits'] as $v) {
                $gov = trim($v['governorate']);
                if ($gov && !str_contains($gov, 'المجموع') && !in_array($gov, $uniqueGovs)) $uniqueGovs[] = $gov;
            }
            foreach ($visits['countries_visits'] as $v) {
                $country = trim($v['country']);
                if ($country && !str_contains($country, 'المجموع') && !in_array($country, $uniqueCountries)) $uniqueCountries[] = $country;
            }
            foreach ($visits['eye_tests'] as $v) {
                $test = trim($v['test']);
                if ($test && !str_contains($test, 'المجموع') && !in_array($test, $uniqueEyeTests)) $uniqueEyeTests[] = $test;
            }
            foreach ($visits['lab_tests'] as $v) {
                $test = trim($v['test']);
                if ($test && !str_contains($test, 'المجموع') && !in_array($test, $uniqueLabTests)) $uniqueLabTests[] = $test;
            }
            

        }
        
        $this->command->info("Seeding Lookups...");
        
        $docMap = [];
        foreach ($uniqueDoctors as $docName) {
            $doc = Doctor::create(['name' => $docName]);
            $docMap[$docName] = $doc->id;
        }
        
        $govMap = [];
        foreach ($uniqueGovs as $govName) {
            $gov = Governorate::create(['name' => $govName]);
            $govMap[$govName] = $gov->id;
        }
        
        $countryMap = [];
        foreach ($uniqueCountries as $countryName) {
            $country = Country::create(['name' => $countryName]);
            $countryMap[$countryName] = $country->id;
        }
        
        $eyeTestMap = [];
        foreach ($uniqueEyeTests as $testName) {
            $test = TestType::create(['name' => $testName]);
            $eyeTestMap[$testName] = $test->id;
        }
        
        $labTestMap = [];
        foreach ($uniqueLabTests as $testName) {
            $test = LabTestType::create(['name' => $testName]);
            $labTestMap[$testName] = $test->id;
        }
        
        $uniqueOps = [];
        foreach ($data as $month => $monthData) {
            // Include both generic surgeries and doc surgeries to capture all operations
            $allSurgeries = array_merge($monthData['surgeries'] ?? [], $monthData['surgeries_by_doc'] ?? []);
            foreach ($allSurgeries as $s) {
                $op = trim($s['operation']);
                $classStr = trim($s['classification']);
                if ($op && !str_contains($op, 'المجموع') && !isset($uniqueOps[$op])) {
                    $uniqueOps[$op] = $classStr;
                }
            }
        }
        
        $opMap = [];
        foreach ($uniqueOps as $opName => $classStr) {
            $enumClass = 'صغرى';
            if (str_contains($classStr, 'كبرى') && str_contains($classStr, 'فوق')) {
                $enumClass = 'فوق الكبرى';
            } elseif (str_contains($classStr, 'كبرى')) {
                $enumClass = 'كبرى';
            } elseif (str_contains($classStr, 'وسطى') || str_contains($classStr, 'حقن') || str_contains($classStr, 'ليزر')) {
                $enumClass = 'وسطى (ليزر)'; // Default wasty
                if (str_contains($classStr, 'حقن')) $enumClass = 'وسطى (حقن)';
            } elseif (str_contains($classStr, 'خاصة')) {
                $enumClass = 'خاصة';
            }
            $op = OperationName::create(['name' => $opName, 'classification' => $enumClass]);
            $opMap[$opName] = $op->id;
        }
        
        // Ensure default clinic unit exists
        $clinicUnitId = ClinicUnit::first()->id ?? 1;
        // Fetch sectors mapped by name approximately
        $sectorMap = Sector::pluck('id', 'name')->toArray();
        $defaultSector = array_values($sectorMap)[0] ?? 1;

        $this->command->info("Seeding Transactions...");
        
        foreach ($data as $month => $monthData) {
            $date = "2026-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-01";
            
            // 1. Doctors Visits (The only source of truth for total visits)
            $visitsData = [];
            foreach ($monthData['visits']['doctors_visits'] as $v) {
                $docName = $this->normalizeDoctorName($v['doctor']);
                $count = (int)$v['count'];
                if ($count > 0 && !str_contains($docName, 'المجموع') && isset($docMap[$docName])) {
                    for ($i = 0; $i < $count; $i++) {
                        $visitsData[] = [
                            'patient_name' => 'مريض مجهول',
                            'visit_date' => $date,
                            'doctor_id' => $docMap[$docName],
                            'clinic_unit_id' => $clinicUnitId,
                            'governorate_id' => null,
                            'country_id' => null,
                            'status' => 'مدفوع',
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                }
            }
            // Shuffle to randomize distribution later
            shuffle($visitsData);
            
            // 2. Assign Governorates to the visits
            $govIndex = 0;
            foreach ($monthData['visits']['governorates_visits'] as $v) {
                $govName = trim($v['governorate']);
                $count = (int)$v['count'];
                if ($count > 0 && !str_contains($govName, 'المجموع') && isset($govMap[$govName])) {
                    for ($i = 0; $i < $count; $i++) {
                        if ($govIndex < count($visitsData)) {
                            $visitsData[$govIndex]['governorate_id'] = $govMap[$govName];
                            $govIndex++;
                        }
                    }
                }
            }
            
            // 3. Assign Countries to the visits
            $countryIndex = 0;
            foreach ($monthData['visits']['countries_visits'] as $v) {
                $countryName = trim($v['country']);
                $count = (int)$v['count'];
                if ($count > 0 && !str_contains($countryName, 'المجموع') && isset($countryMap[$countryName])) {
                    for ($i = 0; $i < $count; $i++) {
                        // Find the first visit without a country
                        while ($countryIndex < count($visitsData) && isset($visitsData[$countryIndex]['country_id'])) {
                            $countryIndex++;
                        }
                        if ($countryIndex < count($visitsData)) {
                            $visitsData[$countryIndex]['country_id'] = $countryMap[$countryName];
                            $countryIndex++;
                        }
                    }
                }
            }
            
            // Insert all visits for the month
            foreach (array_chunk($visitsData, 1000) as $chunk) { DB::table('visits')->insert($chunk); }
            
            // Get inserted visit IDs to attach tests to them
            $visitIds = DB::table('visits')->where('visit_date', $date)->pluck('id')->toArray();
            
            // 4. Eye Tests
            if (count($visitIds) > 0) {
                $eyeTestsData = [];
                foreach ($monthData['visits']['eye_tests'] as $v) {
                    $testName = trim($v['test']);
                    $count = (int)$v['count'];
                    if ($count > 0 && !str_contains($testName, 'المجموع') && isset($eyeTestMap[$testName])) {
                        for ($i = 0; $i < $count; $i++) {
                            $eyeTestsData[] = [
                                'visit_id' => $visitIds[array_rand($visitIds)], // Assign to random visit (hence random doctor)
                                'test_date' => $date,
                                'test_type_id' => $eyeTestMap[$testName],
                                'created_at' => now(),
                                'updated_at' => now()
                            ];
                        }
                    }
                }
                foreach (array_chunk($eyeTestsData, 1000) as $chunk) { DB::table('eye_tests')->insert($chunk); }
                
                // 5. Lab Tests
                $labTestsData = [];
                foreach ($monthData['visits']['lab_tests'] as $v) {
                    $testName = trim($v['test']);
                    $count = (int)$v['count'];
                    if ($count > 0 && !str_contains($testName, 'المجموع') && isset($labTestMap[$testName])) {
                        for ($i = 0; $i < $count; $i++) {
                            $labTestsData[] = [
                                'visit_id' => $visitIds[array_rand($visitIds)],
                                'test_date' => $date,
                                'lab_test_type_id' => $labTestMap[$testName],
                                'created_at' => now(),
                                'updated_at' => now()
                            ];
                        }
                    }
                }
                foreach (array_chunk($labTestsData, 1000) as $chunk) { DB::table('lab_tests')->insert($chunk); }
            }
            
            // 6. Surgeries (Now using specific doctor mappings!)
            $surgeriesData = [];
            foreach ($monthData['surgeries_by_doc'] ?? [] as $s) {
                $opName = trim($s['operation']);
                $class = trim($s['classification']);
                $docName = $this->normalizeDoctorName($s['doctor']);
                $count = (int)$s['count'];
                
                $sectorId = $defaultSector;
                if (str_contains($class, 'خاص')) {
                    $sectorId = $sectorMap['القطاع الخاص'] ?? $sectorId;
                } elseif (str_contains($class, 'عام')) {
                    $sectorId = $sectorMap['القطاع العام'] ?? $sectorId;
                } elseif (str_contains($class, 'صحة')) {
                    $sectorId = $sectorMap['قطاع الصحة'] ?? $sectorId;
                }
                
                if ($count > 0 && !str_contains($opName, 'المجموع') && isset($opMap[$opName]) && isset($docMap[$docName])) {
                    for ($i = 0; $i < $count; $i++) {
                        $surgeriesData[] = [
                            'patient_name' => 'مريض مجهول',
                            'op_date' => $date,
                            'operation_name_id' => $opMap[$opName],
                            'doctor_id' => $docMap[$docName], // Assign to the CORRECT doctor!
                            'sector_id' => $sectorId,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                }
            }
            foreach (array_chunk($surgeriesData, 1000) as $chunk) { DB::table('surgeries')->insert($chunk); }
        }
        
        $this->command->info("All word data seeded successfully!");
    }
}
