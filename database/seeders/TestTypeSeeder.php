<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\TestType;

class TestTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'فحص البصر',
            'فحص قوة العدسة',
            'فحص الشبكية OCT',
            'فحص سونار العين',
            'فحص قاع العين FUNDUS',
            'فحص تصوير القرنية C.T',
            'فحص خلايا القرنية S.M',
            'فحص صبغة الفلورسين',
            'فحص الساحة البصرية FDT',
        ];
        foreach ($types as $t) { TestType::create(['name' => $t]); }
    }
}
