<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use \Illuminate\Database\Console\Seeds\WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            // Users first
            UserSeeder::class,
            // Reference/Lookup tables
            DoctorSeeder::class,
            CountrySeeder::class,
            GovernorateSeeder::class,
            TestTypeSeeder::class,
            SectorSeeder::class,
            ClinicUnitSeeder::class,
            LabTestTypeSeeder::class,
            OperationNameSeeder::class,
            // ── البيانات الحقيقية لمايو 2026 ──
            RealReportSeeder::class,
        ]);
    }
}
