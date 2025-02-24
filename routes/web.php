<?php


use Illuminate\Support\Facades\Route;
// client
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductsController;
use App\Http\Controllers\Client\CartController;


// admin
use App\Http\Controllers\Admin\Controller;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\VouchersController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AttributesNameController;
use App\Http\Controllers\Admin\AttributesValuesController;
use App\Http\Controllers\Admin\ProductController;


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/chat', [HomeController::class, 'room'])->name('chat');
Route::get('/product', [HomeController::class, 'products'])->name('product');
Route::POST('/product/addToCart', [ProductsController::class, 'addToCart'])->name('addToCart');
Route::get('product/{slug}', [ProductsController::class, 'detail'])->name('productDetail');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');



Route::prefix('admin/')
    ->group(function () {
        Route::get("/", [Controller::class, 'index'])->name("admin");
        Route::resource('products', ProductController::class);
        Route::resource("category", CategoryController::class);
        Route::resource('attributes', AttributesNameController::class);
        Route::resource('attribute-values', AttributesValuesController::class);
        Route::resource('brands', BrandsController::class);
        Route::resource('users', UserController::class);

        // voucher
        Route::get('/vouchers', [VouchersController::class, 'index'])->name('vouchers.index');
        // Tạo voucher mới
        Route::get('/vouchers/create', [VouchersController::class, 'create'])->name('vouchers.create');
        Route::post('/vouchers', [VouchersController::class, 'store'])->name('vouchers.store');
        // Chỉnh sửa voucher
        Route::get('/vouchers/{id}/edit', [VouchersController::class, 'edit'])->name('vouchers.edit');
        Route::put('/vouchers/{id}', [VouchersController::class, 'update'])->name('vouchers.update');
        // Xóa voucher
        Route::delete('/vouchers/{id}', [VouchersController::class, 'destroy'])->name('vouchers.destroy');

        // Bình luận
        Route::get('/comment', [CommentController::class, 'index'])->name('comment.index');
        Route::get('/comment/create', [CommentController::class, 'create'])->name('comment.create');
        Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');


        // Đơn hàng
        // Route::get("/qldonhang", [Controller::class, 'donhang']);
        Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
        Route::delete('/orders/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');
        Route::get('/orders/{id}', [OrdersController::class, 'show'])->name('orders.show');
        Route::get('orders/{id}/edit', [OrdersController::class, 'edit'])->name('orders.edit');
        Route::post('orders/{id}', [OrdersController::class, 'update'])->name('orders.update');
        Route::post('/orders/{id}/update', [OrdersController::class, 'update'])->name('orders.update');
    });
