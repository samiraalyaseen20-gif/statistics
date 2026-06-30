<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model {
    protected $fillable = ['name'];
    public function surgeries() { return $this->hasMany(Surgery::class); }
}
