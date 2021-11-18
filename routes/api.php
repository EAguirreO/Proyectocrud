<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
Route::put('/categories/{id}', [CategoryController::class, 'edit']);

Route::get('/subcategories', [SubcategoryController::class, 'index']);
Route::get('/subcategories/{id}', [SubcategoryController::class, 'show']);
Route::post('/subcategories', [SubcategoryController::class, 'store']);
Route::delete('/subcategories/{id}', [SubcategoryController::class, 'destroy']);
Route::put('/subcategories/{id}', [SubcategoryController::class, 'edit']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::post('/products/{id}', [ProductController::class, 'edit']);