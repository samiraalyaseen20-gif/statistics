<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\OperationName;

class OperationNameSeeder extends Seeder
{
    public function run(): void
    {
        // جميع العمليات المستخرجة من الملف الثاني (الإحصائية التفصيلية)
        $ops = [
            // خاصة
            ['name' => 'قص السائل الزجاجي',                       'classification' => 'خاصة'],
            ['name' => 'رفع ماء أسود + رفع ساد',                  'classification' => 'خاصة'],
            ['name' => 'زرع صمام أحمد مع رفع ماء أسود + رفع ساد','classification' => 'خاصة'],
            // فوق الكبرى
            ['name' => 'رفع ساد + زراعة عدسة',                    'classification' => 'فوق الكبرى'],
            ['name' => 'رفع سليكون + زرع عدسة',                   'classification' => 'فوق الكبرى'],
            ['name' => 'زرع عدسة ثانوية',                          'classification' => 'فوق الكبرى'],
            ['name' => 'زرع صمام أحمد (داء الزرقاء)',              'classification' => 'فوق الكبرى'],
            // كبرى
            ['name' => 'غسل حجرة',                                'classification' => 'كبرى'],
            ['name' => 'رفع سليكون',                               'classification' => 'كبرى'],
            ['name' => 'تعديل هطول الأجفان',                       'classification' => 'كبرى'],
            ['name' => 'تصليب القرنية',                            'classification' => 'كبرى'],
            ['name' => 'الحول',                                    'classification' => 'كبرى'],
            ['name' => 'رفع ظفرة',                                 'classification' => 'كبرى'],
            // وسطى (حقن)
            ['name' => 'حقن الايليا',                              'classification' => 'وسطى (حقن)'],
            ['name' => 'حقن الافاستين',                            'classification' => 'وسطى (حقن)'],
            ['name' => 'حقن اللوسنتس',                             'classification' => 'وسطى (حقن)'],
            ['name' => 'حقن الكيناكورت',                           'classification' => 'وسطى (حقن)'],
            ['name' => 'حقن الفابزمو',                             'classification' => 'وسطى (حقن)'],
            ['name' => 'حقن الاكتيليس',                            'classification' => 'وسطى (حقن)'],
            // وسطى (ليزر)
            ['name' => 'الليزر',                                   'classification' => 'وسطى (ليزر)'],
            // صغرى
            ['name' => 'رفع كيس دهني',                             'classification' => 'صغرى'],
            ['name' => 'رفع ورم من مجرى الدمع',                   'classification' => 'صغرى'],
            ['name' => 'رفع ورم (درمويد)',                         'classification' => 'صغرى'],
            ['name' => 'تسليك مجرى الدمع',                        'classification' => 'صغرى'],
            ['name' => 'رفع جسم غريب',                             'classification' => 'صغرى'],
            ['name' => 'رفع جسم غريب (خيط)',                      'classification' => 'صغرى'],
            ['name' => 'رفع جسم غريب (من القرنية)',                'classification' => 'صغرى'],
            ['name' => 'فحص تحت التخدير العام',                   'classification' => 'صغرى'],
            ['name' => 'رفع ثالول',                                'classification' => 'صغرى'],
        ];
        foreach ($ops as $op) { OperationName::firstOrCreate($op); }
    }
}
