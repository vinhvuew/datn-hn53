<?php

use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\ProductController;
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


//admin
Route::prefix('admin')->group(function () {
    Route::get("/", [DashBoardController::class, "dashBoard"]);
    Route::get('/list-product', [ProductController::class, 'listProduct']);
    Route::get('/add-product', [ProductController::class, 'addProduct']);
});
