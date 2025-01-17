<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\Controller;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
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
Route::get("/category", [Controller::class, 'category']);
Route::get("/product", [Controller::class, 'product']);
Route::get("/voucher", [Controller::class, 'voucher']);

Route::prefix('admin/')->group(function () {
    Route::resource('users', UserController::class);
    
});