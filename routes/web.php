<?php

use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Controller;
use App\Http\Controllers\Admin\VouchersController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AttributesNameController;
use App\Http\Controllers\Admin\AttributesValuesController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", [Controller::class, 'index']);

Route::prefix('admin/')->group(function () {
    Route::resource('products', ProductsController::class);
    Route::resource("category", CategoryController::class);
    Route::resource('attributes', AttributesNameController::class);
    Route::resource('attribute-values', AttributesValuesController::class);
    Route::resource('brands', BrandsController::class);
    Route::resource('users', UserController::class);
  
Route::get('/voucher', [VouchersController::class, 'index'])->name('vouchers.view');


Route::get('/vouchers/create', [VouchersController::class, 'create'])->name('voucher.create');

Route::post('/vouchers', [VouchersController::class, 'store'])->name('voucher.store');


Route::get('/vouchers/{id}/edit', [VouchersController::class, 'edit'])->name('vouchers.edit');

Route::put('/vouchers/{id}', [VouchersController::class, 'update'])->name('vouchers.update');


Route::delete('/vouchers/{id}', [VouchersController::class, 'destroy'])->name('voucher.destroy');

});

