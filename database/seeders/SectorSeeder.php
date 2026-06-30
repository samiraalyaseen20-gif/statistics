<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Sector;

class SectorSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['قطاع الصحة', 'عتبة الخاص', 'عتبة العام'] as $s) {
            Sector::create(['name' => $s]);
        }
    }
}
