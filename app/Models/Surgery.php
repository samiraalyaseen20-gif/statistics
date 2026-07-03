<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Surgery extends Model {
    protected $fillable = ['patient_name','doctor_id','operation_name_id','sector_id','governorate_id','country_id','op_date','classification'];
    protected $casts = ['op_date' => 'date'];

    public function doctor()        { return $this->belongsTo(Doctor::class); }
    public function operationName() { return $this->belongsTo(OperationName::class); }
    public function sector()        { return $this->belongsTo(Sector::class); }
    public function governorate()   { return $this->belongsTo(Governorate::class); }
    public function country()       { return $this->belongsTo(Country::class); }
}
