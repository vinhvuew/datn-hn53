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

// Routes Ql UserUser
Route::prefix('admin')->name('admin.')->group(function () {
    // Hiển thị
    Route::resource('users', UserController::class,);
    
    // Thêm mới
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    
    // Chỉnh sửa
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    
    // Xóa
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
