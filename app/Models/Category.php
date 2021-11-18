<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'orden', 'estado', 'slug'];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
    public function subcategories(){
        return $this->hasMany(Subcategory::class);
    }
}
