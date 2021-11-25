<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Livewire\Productos;
use App\Http\Livewire\Subcategorias;

Route::get('', [HomeController::class, 'index'])->name('admin.dashboard');
Route::get('categoria', function(){
    return view('categories');
});
Route::get('subcategoria', function(){
    return view('subcategories');
});
Route::get('producto', function(){
    return view('products');
});
// Route::get('users/{id}', function ($id) {
    
// });