<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EyeTest extends Model {
    protected $fillable = ['visit_id','test_type_id','test_date'];
    protected $casts = ['test_date' => 'date'];
    public function visit()    { return $this->belongsTo(Visit::class); }
    public function testType() { return $this->belongsTo(TestType::class); }
}
