<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AdminController::class, 'admincp'])->name('admin-cp');

Route::post('login', [AdminController::class, 'login'])->name('login');
Route::get('logout', [AdminController::class, 'logout']);
Route::middleware(['auth'])->group(function () {
    //After Login the routes are accept by the loginUsers...
    Route::get('dashboard', [AdminController::class, 'dashboard']);
    Route::resource('customers', CustomerController::class);
    Route::resource('orders', OrderController::class);

    // Products Route
    Route::get('products', [ProductController::class, 'products']);
    Route::get('product/create', [ProductController::class, 'productcreate']);
    Route::get('product/edit/{product_id}', [ProductController::class, 'productedit']);
    Route::get('product/show/{product_id}', [ProductController::class, 'productshow']);
    Route::post('product/store', [ProductController::class, 'productstore']);
    Route::put('product/update/{product_id}', [ProductController::class, 'productupdate']);
    Route::delete('product/delete/{product_id}', [ProductController::class, 'productdelete']);
    // Variants Route
    Route::get('variant/create/{product_id}', [ProductController::class, 'variantcreate']);
    Route::get('variant/edit/{variant_id}', [ProductController::class, 'variantedit']);
    Route::get('variant/show/{variant_id}/{product_id}', [ProductController::class, 'variantshow']);
    Route::post('variant/store', [ProductController::class, 'variantstore']);
    Route::put('variant/update/{id}', [ProductController::class, 'variantupdate']);
    Route::delete('variant/delete/{variant_id}/{product_id}', [ProductController::class, 'variantdelete']);

    Route::get('getvariant/{product_id}', [ProductController::class, 'getVariant']);
    Route::get('getcustomerhistory/{customer_id}', [CustomerController::class, 'getcustomerhistory']);
});
