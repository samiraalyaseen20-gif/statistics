$start_date = '2026-06-01';
$end_date = '2026-06-30';

$defaultDoc = \App\Models\Doctor::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();
$defaultOp  = \App\Models\OperationName::orderBy('display_order', 'asc')->orderBy('name', 'asc')->first();

echo "Default Doctor: [" . ($defaultDoc ? $defaultDoc->name : 'NONE') . "] ID: " . ($defaultDoc ? $defaultDoc->id : 'NONE') . "\n";
echo "Default Operation: [" . ($defaultOp ? $defaultOp->name : 'NONE') . "] ID: " . ($defaultOp ? $defaultOp->id : 'NONE') . "\n\n";

if ($defaultDoc && $defaultOp) {
    $rows = \App\Models\Surgery::whereBetween('op_date', [$start_date, $end_date])
        ->where('doctor_id', $defaultDoc->id)
        ->where('operation_name_id', $defaultOp->id)
        ->get();
        
    echo "Found " . $rows->count() . " records for default doc & op in June 2026:\n";
    foreach ($rows as $r) {
        echo "classification=[{$r->classification}] sector_id=[{$r->sector_id}] gov_id=[{$r->governorate_id}] country_id=[{$r->country_id}] patient=[{$r->patient_name}]\n";
    }
}
