<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'department';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre'];

    public function provinces(){
        return $this->hasMany(Province::class);
    }
}
