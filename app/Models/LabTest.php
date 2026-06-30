<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LabTest extends Model {
    protected $fillable = ['visit_id','lab_test_type_id','test_date'];
    protected $casts = ['test_date' => 'date'];
    public function visit()       { return $this->belongsTo(Visit::class); }
    public function labTestType() { return $this->belongsTo(LabTestType::class); }
}
