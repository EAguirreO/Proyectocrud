<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralOrder extends Model
{
    use HasFactory;
    protected $table = 'general_order';
    protected $primaryKey = 'id';
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function productorders(){
        return $this->hasMany(ProductOrder::class);
    }
}