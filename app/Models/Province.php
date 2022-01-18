<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'province';
    protected $primaryKey = 'id';
    protected $fillable = ['id','departamento', 'nombre'];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function districts(){
        return $this->hasMany(District::class);
    }

    public function generalorders(){
        return $this->hasMany(GeneralOrder::class);
    }
}
