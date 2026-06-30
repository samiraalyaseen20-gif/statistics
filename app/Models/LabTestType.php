<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LabTestType extends Model {
    protected $fillable = ['name'];
    public function labTests() { return $this->hasMany(LabTest::class); }
}
