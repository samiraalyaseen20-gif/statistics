<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OperationName extends Model {
    protected $fillable = ['name', 'classification'];
    public function surgeries() { return $this->hasMany(Surgery::class); }
}
