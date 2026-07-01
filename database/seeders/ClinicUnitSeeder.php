<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ClinicUnit;

class ClinicUnitSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['استشارية العيون العامة', 'استشارية التخصصات الدقيقة'] as $u) {
            ClinicUnit::firstOrCreate(['name' => $u]);
        }
    }
}
