<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'district';
    protected $primaryKey = 'id';
    protected $fillable = ['id','provincia', 'nombre'];

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function generalorders(){
        return $this->hasMany(GeneralOrder::class);
    }
}
