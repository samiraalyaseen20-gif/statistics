<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ClinicUnit extends Model {
    protected $fillable = ['name'];
    public function visits() { return $this->hasMany(Visit::class); }
}
