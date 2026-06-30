<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Country extends Model {
    protected $fillable = ['name'];
    public function visits() { return $this->hasMany(Visit::class); }
    public function surgeries() { return $this->hasMany(Surgery::class); }
}
