<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Livewire\AdminProductOrders;
use App\Http\Livewire\Productos;
use App\Http\Livewire\Subcategorias;

Route::get('', [HomeController::class, 'index'])->middleware(['auth:sanctum', 'verify.is.admin'])->name('admin.dashboard');

Route::get('categoria', function(){
    return view('categories');
})->middleware('auth:sanctum', 'verify.is.admin');

Route::get('subcategoria', function(){
    return view('subcategories');
})->middleware('auth:sanctum', 'verify.is.admin');

Route::get('producto', function(){
    return view('products');
})->middleware('auth:sanctum', 'verify.is.admin');

Route::get('orden', function(){
    return view('orders');
})->name('admin.orders')->middleware('auth:sanctum', 'verify.is.admin');

Route::get('orden/{id}', [AdminOrderController::class, 'update'])->middleware('auth:sanctum', 'verify.is.admin')->name('admin.product.orders');
// Route::get('users/{id}', function ($id) {
    
// });