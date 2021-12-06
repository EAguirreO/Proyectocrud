<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Livewire\AdminProductOrders;
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
Route::get('orden', function(){
    return view('orders');
})->name('admin.orders');
Route::get('orden/{id}', [AdminOrderController::class, 'update'])->name('admin.product.orders');
// Route::get('users/{id}', function ($id) {
    
// });