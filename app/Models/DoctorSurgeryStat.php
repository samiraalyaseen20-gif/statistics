<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DoctorSurgeryStat extends Model
{
    protected $fillable = [
        'doctor_id',
        'classification',
        'sector_key',
        'sector_id',
        'stat_month',
        'quantity',
    ];

    protected $casts = ['stat_month' => 'date'];

    public function doctor()  { return $this->belongsTo(Doctor::class); }
    public function sector()  { return $this->belongsTo(Sector::class); }
}
