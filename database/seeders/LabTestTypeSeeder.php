<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\LabTestType;

class LabTestTypeSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['RBS','WBC','Hp','PCV','HIV','HCV','HBV','PT','PTT','INR'] as $t) {
            LabTestType::firstOrCreate(['name' => $t]);
        }
    }
}
