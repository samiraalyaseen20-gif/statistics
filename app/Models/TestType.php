<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TestType extends Model {
    protected $fillable = ['name'];
    public function eyeTests() { return $this->hasMany(EyeTest::class); }
}
