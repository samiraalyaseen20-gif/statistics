<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visit;
use App\Models\EyeTest;
use App\Models\LabTest;
use App\Models\Surgery;
use App\Models\Doctor;
use App\Models\ClinicUnit;
use App\Models\Governorate;
use App\Models\Country;
use App\Models\TestType;
use App\Models\LabTestType;
use App\Models\OperationName;
use App\Models\Sector;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🔄 توليد بيانات تجريبية...');

        // ── Load lookup IDs ──────────────────────────────────────────
        $doctors      = Doctor::all();
        $units        = ClinicUnit::all();
        $govs         = Governorate::all();
        $countries    = Country::all();
        $testTypes    = TestType::all();
        $labTypes     = LabTestType::all();
        $opNames      = OperationName::all();
        $sectors      = Sector::all();

        $names = [
            'أحمد محمد الكربلائي','زينب علي الحسيني','محمد حسين الموسوي','فاطمة عباس النجفي',
            'علي جاسم العبيدي','مريم كاظم الزبيدي','حسين عبد الكريم','سارة أحمد البغدادي',
            'عمر فاروق الدليمي','نور محمد الحيدري','عبد الله رزاق الربيعي','هدى ياسين العاملي',
            'قاسم عادل الشمري','زهراء طاهر الملا','يوسف رياض البصري','آلاء حسين الجابري',
            'حيدر فلاح العزاوي','رنا علاء الطائي','كريم ناصر المحمداوي','دلال صادق الخفاجي',
            'صالح عودة الجبوري','إيمان فريد السامرائي','عقيل جبار الخزرجي','وفاء هادي العتابي',
            'إبراهيم سلمان الكعبي','رباب حسن الفضلي','مصطفى رشيد الراشدي','زينب نوري العلواني',
            'ثائر محمد الجلبي','سلمى عبد الرضا الزهراوي','ليث خليل الربيعي','سجى حامد العامري',
        ];

        // ── 120 VISITS (مايو 2026) ───────────────────────────────────
        $visitRecords = [];

        // توزيع الزيارات بين الوحدتين والأطباء والمحافظات
        $doctorWeights = [
            // doctor_id => visits count (مرتبطة بجدول 2 من الملف)
            1=>8, 2=>25, 3=>6, 4=>10, 5=>6, 6=>16, 7=>55, 8=>3, 9=>9, 10=>33,
            11=>16, 12=>6, 13=>5, 14=>8, 15=>4,
        ];

        // محافظات كربلاء تأخذ معظم الزيارات
        $govWeights = [1=>60, 2=>10, 3=>4, 4=>8, 5=>5, 6=>4, 7=>3, 8=>2, 9=>2, 10=>1, 11=>1];

        foreach ($doctorWeights as $docId => $count) {
            $unit = ($docId <= 2) ? $units->firstWhere('name', 'استشارية التخصصات الدقيقة')
                                  : $units->firstWhere('name', 'استشارية العيون العامة');
            $unitId = $unit->id ?? $units->first()->id;

            for ($i = 0; $i < $count; $i++) {
                $govId     = null;
                $countryId = null;
                $rand = rand(1, 100);
                if ($rand <= 96) { // 96% داخل العراق
                    $govId = $this->weightedRandom($govWeights);
                } else { // 4% خارج العراق
                    $countryId = $countries->random()->id;
                }

                $visitRecords[] = [
                    'patient_name'   => $names[array_rand($names)],
                    'doctor_id'      => $docId,
                    'clinic_unit_id' => $unitId,
                    'governorate_id' => $govId,
                    'country_id'     => $countryId,
                    'status'         => rand(0, 4) > 0 ? 'مدفوع' : 'غير مدفوع',
                    'visit_date'     => '2026-05-' . str_pad(rand(1, 31), 2, '0', STR_PAD_LEFT),
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ];
            }
        }

        foreach (array_chunk($visitRecords, 50) as $chunk) {
            Visit::insert($chunk);
        }
        $this->command->info('  ✅ ' . count($visitRecords) . ' زيارة استشارية');

        // ── Eye Tests — 200+ فحص بصري ────────────────────────────────
        $visits     = Visit::all();
        $eyeRecords = [];
        // توزيع الفحوصات بأوزان تعكس جدول (5) من الملف
        $testWeights = [1=>40, 2=>9, 3=>19, 4=>2, 5=>1, 6=>2, 7=>1, 8=>1, 9=>1];

        foreach ($visits->random(min(80, $visits->count())) as $visit) {
            $numTests = rand(1, 3);
            for ($t = 0; $t < $numTests; $t++) {
                $testTypeId = $this->weightedRandom($testWeights);
                $eyeRecords[] = [
                    'visit_id'    => $visit->id,
                    'test_type_id'=> $testTypeId,
                    'test_date'   => $visit->visit_date,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }
        }
        foreach (array_chunk($eyeRecords, 50) as $chunk) {
            EyeTest::insert($chunk);
        }
        $this->command->info('  ✅ ' . count($eyeRecords) . ' فحص بصري');

        // ── Lab Tests ────────────────────────────────────────────────
        $labRecords = [];
        foreach ($visits->random(min(60, $visits->count())) as $visit) {
            $labRecords[] = [
                'visit_id'        => $visit->id,
                'lab_test_type_id'=> $labTypes->random()->id,
                'test_date'       => $visit->visit_date,
                'created_at'      => now(),
                'updated_at'      => now(),
            ];
        }
        foreach (array_chunk($labRecords, 50) as $chunk) {
            LabTest::insert($chunk);
        }
        $this->command->info('  ✅ ' . count($labRecords) . ' تحليل مختبري');

        // ── Surgeries (مايو 2026) ────────────────────────────────────
        // توزيع عمليات الأطباء بشكل يعكس جدول (10) من الملف
        $surgeryData = [
            // [doctor_id, op_name_pattern, sector_name, count]
            [10, 'حقن الافاستين',         'قطاع الصحة', 30],
            [10, 'حقن الايليا',           'قطاع الصحة', 15],
            [10, 'رفع ساد + زراعة عدسة', 'عتبة الخاص', 8],
            [10, 'الليزر',               'قطاع الصحة', 4],
            [7,  'رفع ساد + زراعة عدسة', 'فوق الكبرى', 15],
            [7,  'رفع ساد + زراعة عدسة', 'عتبة الخاص', 8],
            [7,  'رفع ساد + زراعة عدسة', 'عتبة العام',  5],
            [7,  'الليزر',               'قطاع الصحة', 5],
            [2,  'رفع ساد + زراعة عدسة', 'عتبة الخاص', 10],
            [2,  'رفع سليكون',           'عتبة الخاص', 6],
            [2,  'قص السائل الزجاجي',    'عتبة الخاص', 5],
            [9,  'حقن الافاستين',         'قطاع الصحة', 12],
            [9,  'حقن الايليا',           'قطاع الصحة', 6],
            [9,  'رفع ساد + زراعة عدسة', 'عتبة الخاص', 4],
            [6,  'حقن الايليا',           'قطاع الصحة', 8],
            [6,  'حقن الافاستين',         'قطاع الصحة', 5],
            [6,  'رفع ساد + زراعة عدسة', 'عتبة الخاص', 4],
            [4,  'حقن الايليا',           'قطاع الصحة', 6],
            [4,  'حقن الافاستين',         'قطاع الصحة', 4],
            [4,  'رفع ساد + زراعة عدسة', 'عتبة الخاص', 2],
            [1,  'قص السائل الزجاجي',    'عتبة الخاص', 6],
            [1,  'حقن الايليا',           'قطاع الصحة', 3],
            [1,  'رفع ساد + زراعة عدسة', 'عتبة الخاص', 2],
            [8,  'حقن الايليا',           'قطاع الصحة', 8],
            [8,  'حقن اللوسنتس',          'قطاع الصحة', 3],
            [11, 'حقن الافاستين',         'قطاع الصحة', 5],
            [11, 'رفع ساد + زراعة عدسة', 'عتبة الخاص', 3],
            [3,  'قص السائل الزجاجي',    'عتبة الخاص', 3],
            [3,  'رفع ساد + زراعة عدسة', 'عتبة الخاص', 2],
            [5,  'رفع ساد + زراعة عدسة', 'عتبة الخاص', 2],
            [12, 'رفع ساد + زراعة عدسة', 'عتبة الخاص', 2],
            [15, 'حقن الافاستين',         'قطاع الصحة', 4],
            [16, 'رفع ساد + زراعة عدسة', 'عتبة الخاص', 1],
        ];

        $surgRecords = [];
        foreach ($surgeryData as [$docId, $opPattern, $sectorName, $count]) {
            $op     = $opNames->where('name', $opPattern)->first() ?? $opNames->first();
            $sector = $sectors->where('name', $sectorName)->first() ?? $sectors->first();
            if (!$op || !$sector) continue;

            for ($i = 0; $i < $count; $i++) {
                $govId     = null;
                $countryId = null;
                if (rand(1, 100) <= 97) {
                    $govId = $this->weightedRandom($govWeights ?? [1=>70, 2=>10, 4=>8, 5=>4, 6=>4, 7=>2, 8=>2]);
                } else {
                    $countryId = $countries->random()->id;
                }
                $surgRecords[] = [
                    'patient_name'      => $names[array_rand($names)],
                    'doctor_id'         => $docId,
                    'operation_name_id' => $op->id,
                    'sector_id'         => $sector->id,
                    'governorate_id'    => $govId,
                    'country_id'        => $countryId,
                    'op_date'           => '2026-05-' . str_pad(rand(1, 31), 2, '0', STR_PAD_LEFT),
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ];
            }
        }

        foreach (array_chunk($surgRecords, 50) as $chunk) {
            Surgery::insert($chunk);
        }
        $this->command->info('  ✅ ' . count($surgRecords) . ' عملية جراحية');

        $this->command->line('');
        $this->command->info('🎉 البيانات التجريبية جاهزة!');
        $this->command->table(
            ['الجدول', 'العدد'],
            [
                ['زيارات استشارية',  count($visitRecords)],
                ['فحوصات بصرية',     count($eyeRecords)],
                ['تحاليل مختبرية',   count($labRecords)],
                ['عمليات جراحية',    count($surgRecords)],
            ]
        );
    }

    /** اختيار عشوائي بأوزان */
    private function weightedRandom(array $weights): int
    {
        $total = array_sum($weights);
        $rand  = rand(1, $total);
        $cum   = 0;
        foreach ($weights as $id => $w) {
            $cum += $w;
            if ($rand <= $cum) return $id;
        }
        return array_key_first($weights);
    }
}
