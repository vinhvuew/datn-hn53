<?php


use App\Http\Controllers\Admin\Controller;
use App\Http\Controllers\Admin\ImageGalleryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\VouchersController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AttributesNameController;
use App\Http\Controllers\Admin\AttributesValuesController;
use Illuminate\Support\Facades\Route;





Route::get("/", [Controller::class, 'index']);
Route::get("/category", [Controller::class, 'category']);
Route::get("/product", [Controller::class, 'product']);
Route::get("/voucher", [Controller::class, 'voucher']);



Route::get('/comment', [CommentController::class, 'index'])->name('comment.index');
Route::get('/comment/create', [CommentController::class, 'create'])->name('comment.create');
Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');






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

// Đơn hàng
// Route::get("/qldonhang", [Controller::class, 'donhang']);
Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
Route::delete('/orders/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');
Route::get('/orders/{id}', [OrdersController::class, 'show'])->name('orders.show');
});
