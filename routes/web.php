<?php


use App\Http\Controllers\Admin\Controller;
use App\Http\Controllers\Admin\ImageGalleryController;
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
Route::get('/image', [ImageGalleryController::class, 'index'])->name('image.index');
Route::get('/image/create', [ImageGalleryController::class, 'create'])->name('image.create');
Route::post('/image/store', [ImageGalleryController::class, 'store'])->name('image.store');











