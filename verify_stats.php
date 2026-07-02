<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

$month = '2026-02-01';
echo "--------------------------------------------------------\n";
echo "--- إحصائيات شهر 2 (شباط 2026) من قاعدة البيانات ---\n";
echo "--------------------------------------------------------\n\n";

echo "1. الزيارات لكل طبيب (تطابق جدول 'اعداد المراجعين لكل طبيب'):\n";
$visits = DB::table('visits')
    ->join('doctors', 'visits.doctor_id', '=', 'doctors.id')
    ->where('visit_date', $month)
    ->select('doctors.name', DB::raw('count(*) as total'))
    ->groupBy('doctors.name')
    ->orderByDesc('total')
    ->get();

$totalV = 0;
foreach ($visits as $v) {
    echo str_pad($v->total, 5, " ", STR_PAD_LEFT) . " : " . $v->name . "\n";
    $totalV += $v->total;
}
echo "---------------------------\n";
echo "المجموع : " . $totalV . "\n\n";

echo "2. العمليات لكل طبيب (تطابق جداول 'العمليات لكل طبيب'):\n";
$surgeries = DB::table('surgeries')
    ->join('doctors', 'surgeries.doctor_id', '=', 'doctors.id')
    ->where('op_date', $month)
    ->select('doctors.name', DB::raw('count(*) as total'))
    ->groupBy('doctors.name')
    ->orderByDesc('total')
    ->get();

$totalS = 0;
foreach ($surgeries as $s) {
    echo str_pad($s->total, 5, " ", STR_PAD_LEFT) . " : " . $s->name . "\n";
    $totalS += $s->total;
}
echo "---------------------------\n";
echo "المجموع : " . $totalS . "\n\n";

echo "3. إحصائية المراجعين حسب المحافظات:\n";
$govs = DB::table('visits')
    ->join('governorates', 'visits.governorate_id', '=', 'governorates.id')
    ->where('visit_date', $month)
    ->select('governorates.name', DB::raw('count(*) as total'))
    ->groupBy('governorates.name')
    ->orderByDesc('total')
    ->get();
$totalG = 0;
foreach ($govs as $g) {
    echo str_pad($g->total, 5, " ", STR_PAD_LEFT) . " : " . $g->name . "\n";
    $totalG += $g->total;
}
echo "---------------------------\n";
echo "المجموع : " . $totalG . "\n\n";

echo "4. إحصائية المراجعين حسب الدول:\n";
$countries = DB::table('visits')
    ->join('countries', 'visits.country_id', '=', 'countries.id')
    ->where('visit_date', $month)
    ->select('countries.name', DB::raw('count(*) as total'))
    ->groupBy('countries.name')
    ->orderByDesc('total')
    ->get();
$totalC = 0;
foreach ($countries as $c) {
    echo str_pad($c->total, 5, " ", STR_PAD_LEFT) . " : " . $c->name . "\n";
    $totalC += $c->total;
}
echo "---------------------------\n";
echo "المجموع : " . $totalC . "\n\n";

echo "5. إحصائيات الفحوصات البصرية:\n";
$eye_tests = DB::table('eye_tests')
    ->join('visits', 'eye_tests.visit_id', '=', 'visits.id')
    ->join('test_types', 'eye_tests.test_type_id', '=', 'test_types.id')
    ->where('visits.visit_date', $month)
    ->select('test_types.name', DB::raw('count(*) as total'))
    ->groupBy('test_types.name')
    ->orderByDesc('total')
    ->get();
$totalE = 0;
foreach ($eye_tests as $e) {
    echo str_pad($e->total, 5, " ", STR_PAD_LEFT) . " : " . $e->name . "\n";
    $totalE += $e->total;
}
echo "---------------------------\n";
echo "المجموع : " . $totalE . "\n\n";

echo "6. إحصائيات الفحوصات المختبرية:\n";
$lab_tests = DB::table('lab_tests')
    ->join('visits', 'lab_tests.visit_id', '=', 'visits.id')
    ->join('lab_test_types', 'lab_tests.lab_test_type_id', '=', 'lab_test_types.id')
    ->where('visits.visit_date', $month)
    ->select('lab_test_types.name', DB::raw('count(*) as total'))
    ->groupBy('lab_test_types.name')
    ->orderByDesc('total')
    ->get();
$totalL = 0;
foreach ($lab_tests as $l) {
    echo str_pad($l->total, 5, " ", STR_PAD_LEFT) . " : " . $l->name . "\n";
    $totalL += $l->total;
}
echo "---------------------------\n";
echo "المجموع : " . $totalL . "\n";

