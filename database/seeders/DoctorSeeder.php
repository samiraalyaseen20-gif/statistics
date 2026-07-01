<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            ['name' => 'د. غياث الدين ثجيل نعمة'],
            ['name' => 'د. حمزة صادق علوان الشريفي'],
            ['name' => 'د. ذوالفقار غني عبد الكندي'],
            ['name' => 'د. منتصر محمد عرب'],
            ['name' => 'د. افراح عبد الزهرة القصير'],
            ['name' => 'د. مؤيد عبد اللطيف صبار'],
            ['name' => 'د. بشرى سليمان علي الصقر'],
            ['name' => 'د. عالء صبري الغانمي'],
            ['name' => 'د. نور رعد كريم'],
            ['name' => 'د. حيدر حسين علي الموسوي'],
            ['name' => 'د. حذيفه سامي جواد العبايجي'],
            ['name' => 'د. اريج هادي كريم'],
            ['name' => 'د. زهراء علوان عيدان الحمداني'],
            ['name' => 'د. خلدون خليل نايف'],
            ['name' => 'د. ايات معتز محمد'],
            ['name' => 'د. محمد بدر محمد الجريان'],
        ];
        foreach ($doctors as $d) { Doctor::firstOrCreate($d); }
    }
}
