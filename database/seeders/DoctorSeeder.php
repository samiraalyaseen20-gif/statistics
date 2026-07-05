<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $orderedDoctors = [
            ['id' => 1,  'name' => 'د. غياث الدين ثجيل نعمه',         'display_order' => 1],
            ['id' => 2,  'name' => 'د. حمزة صادق علوان الشريفي',      'display_order' => 2],
            ['id' => 3,  'name' => 'د. ذو الفقار غني عبد',            'display_order' => 3],
            ['id' => 4,  'name' => 'د. منتصر محمد عرب',               'display_order' => 4],
            ['id' => 17, 'name' => 'د. افراح عبدالزهرة القصير',       'display_order' => 5],
            ['id' => 5,  'name' => 'د. مؤيد عبد اللطيف صبار',        'display_order' => 6],
            ['id' => 6,  'name' => 'د. بشرى سليمان علي الصقر',       'display_order' => 7],
            ['id' => 7,  'name' => 'د. علاء صبري الغانمي',           'display_order' => 8],
            ['id' => 8,  'name' => 'د. نور رعد كريم',                'display_order' => 9],
            ['id' => 9,  'name' => 'د. حيدر حسين علي الموسوي',       'display_order' => 10],
            ['id' => 10, 'name' => 'د. حذيفه سامي جواد العبايجي',    'display_order' => 11],
            ['id' => 11, 'name' => 'د. اريج هادي كريم',              'display_order' => 12],
            ['id' => 13, 'name' => 'د. خلدون خليل نايف',             'display_order' => 13],
            ['id' => 14, 'name' => 'د. ايات معتز محمد',              'display_order' => 14],
            ['id' => 12, 'name' => 'د. زهراء علوان الحمداني',        'display_order' => 15],
            ['id' => 19, 'name' => 'د. محمد بدر محمد الجريان',       'display_order' => 16],
            ['id' => 18, 'name' => 'د. علي رضا(مبادرة النبأ والمراد)', 'display_order' => 17],
        ];

        foreach ($orderedDoctors as $d) {
            $doctor = Doctor::find($d['id']);
            if ($doctor) {
                $doctor->update([
                    'name'          => $d['name'],
                    'display_order' => $d['display_order']
                ]);
            } else {
                // If it doesn't exist, create it with specified ID
                Doctor::create([
                    'id'            => $d['id'],
                    'name'          => $d['name'],
                    'display_order' => $d['display_order']
                ]);
            }
        }
    }
}
