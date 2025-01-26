<?php

use App\Http\Controllers\Admin\Controller;
use App\Http\Controllers\Admin\ImageGalleryController;
use App\Http\Controllers\Admin\AttributesNameController;
use App\Http\Controllers\Admin\AttributesValuesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\CommenController;
use Illuminate\Support\Facades\Route;





Route::get("/", [Controller::class, 'index']);
Route::get("/category", [Controller::class, 'category']);
Route::get("/product", [Controller::class, 'product']);
Route::get("/voucher", [Controller::class, 'voucher']);
Route::get('/image', [ImageGalleryController::class, 'index'])->name('image.index');
Route::get('/image/create', [ImageGalleryController::class, 'create'])->name('image.create');
Route::post('/image/store', [ImageGalleryController::class, 'store'])->name('image.store');
Route::get('/comment', [CommenController::class, 'index'])->name('comment.index');
Route::get('/comment/create', [CommenController::class, 'create'])->name('comment.create');
Route::delete('/comment/{id}', [CommenController::class, 'destroy'])->name('comment.destroy');






Route::prefix('admin/')->group(function () {
    Route::resource('products', ProductsController::class);
    Route::resource('attributes', AttributesNameController::class);
    Route::resource('attribute-values', AttributesValuesController::class);
});




?>