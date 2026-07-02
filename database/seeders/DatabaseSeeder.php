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
            // UserSeeder::class,
            // // Keep basic hardcoded seeders for units and sectors
            // SectorSeeder::class,
            // ClinicUnitSeeder::class,
            // // Run the dynamic Word Data Seeder
            // WordDataSeeder::class,
        ]);
    }
}
