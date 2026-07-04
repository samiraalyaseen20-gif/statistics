<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DoctorOperationStat extends Model {
    protected $fillable = ['doctor_id', 'operation_name_id', 'classification', 'quantity', 'stat_month'];

    public function doctor() { return $this->belongsTo(Doctor::class); }
    public function operationName() { return $this->belongsTo(OperationName::class); }
}
