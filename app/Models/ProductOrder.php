<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;
    protected $table = 'product_order';
    protected $primaryKey = 'id';
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function generalorder(){
        return $this->belongsTo(GeneralOrder::class);
    }
}
