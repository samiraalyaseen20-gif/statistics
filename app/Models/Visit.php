<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model {
    protected $fillable = ['patient_name','doctor_id','clinic_unit_id','governorate_id','country_id','status','visit_date'];
    protected $casts = ['visit_date' => 'date'];

    public function doctor()      { return $this->belongsTo(Doctor::class); }
    public function clinicUnit()  { return $this->belongsTo(ClinicUnit::class); }
    public function governorate() { return $this->belongsTo(Governorate::class); }
    public function country()     { return $this->belongsTo(Country::class); }
    public function eyeTests()    { return $this->hasMany(EyeTest::class); }
    public function labTests()    { return $this->hasMany(LabTest::class); }
}
