<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model {
    protected $fillable = ['name', 'fee'];
    public function visits() { return $this->hasMany(Visit::class); }
    public function surgeries() { return $this->hasMany(Surgery::class); }
}
