<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ViewProductController;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\Filtros;
use App\Http\Livewire\ProductDetail;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebhooksController;
use App\Http\Livewire\DetalleOrden;
use App\Http\Livewire\UserOrders;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/catalogo', function(){
//     return view('catalogo');
// })->name('vistaCatalogo');

Route::get('catalogo', Filtros::class)->name('vistaCatalogo');

// Route::get('catalogo/producto/{id}', [ViewProductController::class, 'mostrarVista'])->name('vistaDetalleProducto');
Route::get('catalogo/producto/{id}', ProductDetail::class)->name('vistaDetalleProducto');

Route::get('cart', CartComponent::class)->name('product.cart');
// Route::get('checkout', CheckoutComponent::class)->name('product.checkout');

Route::get('order/create')->name('create.order')->middleware('auth:sanctum');

Route::get('orders', [OrderController::class, 'pay'])->name('orders.pay')->middleware('auth:sanctum');

Route::post('webhooks/{id}', WebhooksController::class);

Route::get('myorders', UserOrders::class)->name('user.orders')->middleware('auth:sanctum');

Route::get('myorders/{id}', DetalleOrden::class)->name('user.order.details')->middleware(['auth:sanctum', 'verify.user']);

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
// Route::middleware(['auth:sanctum', 'verified'])->get('/admin', function () {
//     return view('admin.index');
// })->name('admin');

