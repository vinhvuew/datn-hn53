<?php

use Illuminate\Support\Facades\Route;
// client
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductsController;
use App\Http\Controllers\Client\LoginRegisterController;
use App\Http\Controllers\Client\PolicyController;
use App\Http\Controllers\Admin\AttributesValuesController;
use App\Http\Controllers\Client\AddressController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\Payment\VNPayController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\CreateNewsController;
// admin
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\VouchersController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AttributesNameController;
use App\Http\Controllers\Admin\OderDeltailController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ThongKeController;
use App\Http\Controllers\Admin\NewsController;



Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/brands', [HomeController::class, 'index_brands'])->name('brand');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/chat', [HomeController::class, 'room'])->name('chat');

Route::get('/product', [HomeController::class, 'products'])->name('product');

Route::post('apply', [OrderController::class, 'applyVoucher'])->name('apply.voucher');

//trang profile
Route::middleware(['auth'])->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index'); // Hiển thị trang profile
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit'); // Hiển thị form chỉnh sửa
    Route::put('/update', [ProfileController::class, 'update'])->name('update'); // Cập nhật thông tin
    Route::put('/update/avatar', [ProfileController::class, 'updateAvatar'])->name('updateAvatar'); // cập nhật avatar
    Route::post('/update/password', [ProfileController::class, 'updatePassword'])->name('updatePassword'); // cập nhật mk
    Route::get('/myOder', [ProfileController::class, 'myOder'])->name('myOder'); // đơn hàng của tôi
    Route::get('myOder/show/{id}/', [ProfileController::class, 'show'])->name('detailOrder');
    // Hủy đơn hàng (Chỉ khi trạng thái là "pending")
    Route::put('/myOder/{id}/cancel', [ProfileController::class, 'cancel'])->name('orders.cancel');
    // Xác nhận đã nhận hàng (Chỉ khi trạng thái là "delivered")
    Route::put('/orders/{id}/confirm-received', [ProfileController::class, 'confirmReceived'])
        ->name('orders.confirm-received');
});

// router phan tin tuc

Route::get('/new', [CreateNewsController::class, 'news'])->name('news');
Route::get('/news/{id}', [CreateNewsController::class, 'show'])->name('news.shows');

Route::get('/product', [ProductsController::class, 'statistical'])->name('product.show');
// Route cho trang sản phẩm với các tham số lọc
Route::get('/products', [ProductsController::class, 'statistical'])->name('products.filter');

// comment
Route::post('/add-comment', [ProductsController::class, 'storeCommet'])->name('add.comment');
Route::post('/add-reply', [ProductsController::class, 'storeReply'])->name('add.reply');
Route::get('/comments/{productId}', [ProductsController::class, 'showComments']);

// address
Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store')->middleware('auth');
Route::post('/apply-voucher', [OrderController::class, 'applyVoucher'])->name('apply.voucher');

Route::get('/vnpay-return', [VNPayController::class, 'handleReturn'])->name('vnpay.return');
// giỏ hàng
Route::POST('/product/addToCart', [ProductsController::class, 'addToCart'])->name('addToCart');
Route::get('product/{slug}', [ProductsController::class, 'detail'])->name('productDetail');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.view');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');

// check out
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/checkout', [HomeController::class, 'checkout'])->name('checkout.view');
Route::post('/checkout/store', [OrderController::class, 'placeOrder'])->name('checkout.store');
Route::put('/cart/update-selection/{id}', [CartController::class, 'updateSelection']);

// dang nhap, dang ky
Route::get('login', [LoginRegisterController::class, 'showForm'])->name('login.show');
Route::post('login', [LoginRegisterController::class, 'login'])->name('login.post');
Route::post('register', [LoginRegisterController::class, 'register'])->name('register.post');
//xac minh email
Route::get('/verify-email/{code}', [LoginRegisterController::class, 'verifyEmail'])->name('verify.email');
//gui lại email xac thuc
Route::post('/resend-verification', [LoginRegisterController::class, 'resendVerification'])->name('resend.verification');
Route::get('/verify-code', [LoginRegisterController::class, 'showVerificationForm'])->name('verification.form');
Route::post('/verify-code', [LoginRegisterController::class, 'verifyCode'])->name('verification.submit');

//quen mat khau
Route::get('/forgot-password', [LoginRegisterController::class, 'showForgotPasswordForm'])->name('password.forgot.form');
Route::post('/forgot-password', [LoginRegisterController::class, 'sendResetCode'])->name('password.forgot');

Route::get('/verify-reset-code', [LoginRegisterController::class, 'showVerifyResetCodeForm'])->name('password.verify.form');
Route::post('/verify-reset-code', [LoginRegisterController::class, 'verifyResetCode'])->name('password.verify');

Route::post('/resend-password', [LoginRegisterController::class, 'resendVerificationForPassword'])->name('password.resend');
Route::get('/reset-password', [LoginRegisterController::class, 'showResetPasswordForm'])->name('password.reset.form');
Route::post('/reset-password', [LoginRegisterController::class, 'resetPassword'])->name('password.reset');

// đăng nhập, đăng ký, đăng xuất user
Route::get('login', [LoginRegisterController::class, 'showForm'])->name('login.show');
Route::post('login', [LoginRegisterController::class, 'login'])->name('login.post');
Route::post('register', [LoginRegisterController::class, 'register'])->name('register.post');
Route::post('logout', [LoginRegisterController::class, 'logout'])->name('logout');

// đăng nhập admin
Route::get('/logad', [UserController::class, 'showAdminLoginForm'])->name('logad');
Route::post('/logad', [UserController::class, 'adminLogin'])->name('admin.logad');
Route::post('/logad/logout', [UserController::class, 'adminLogout'])->name('admin.logout');

// chính sách
Route::get('/policies', [PolicyController::class, 'index'])->name('policies');
// Admin
Route::prefix('admin')->middleware(['admin'])->group(function () {

    Route::get("dashboard", [DashBoardController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('products', ProductController::class);
    Route::resource("category", CategoryController::class);
    Route::resource('attributes', AttributesNameController::class);
    Route::resource('attribute-values', AttributesValuesController::class);
    Route::resource('brands', BrandsController::class);
    Route::resource('users', UserController::class);
    Route::post('/admin/users/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');

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
    Route::prefix('orders')
        ->as('orders.')
        ->controller(OrdersController::class)
        ->group(function () {
            Route::get('/',  'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/{id}/edit',  'edit')->name('edit');
            Route::post('/{id}/update', 'update')->name('update');
            Route::post('cancel/{id}', 'cancel')->name('cancel');
            Route::post('confirmed/{id}', 'confirmed')->name('confirmed');
            Route::post('shipping/{id}', 'shipping')->name('shipping');
            Route::post('delivered/{id}', 'delivered')->name('delivered');
            Route::post('return_request/{id}', 'return_request')->name('return_request');
            Route::post('refuse_return/{id}', 'refuse_return')->name('refuse_return');
            Route::post('refunded/{id}', 'refunded')->name('refunded');
            Route::post('returned_item_received/{id}', 'returned_item_received')->name('returned_item_received');
            Route::post('refund_completed/{id}', 'refund_completed')->name('refund_completed');
        });

    //Thống Kê
    Route::get('/thongke', [ThongKeController::class, 'statistical'])->name('thongke.statistical');

    // Tin Tức
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');

    Route::post('/news/store', [NewsController::class, 'store'])->name('news.store');
    Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{id}/update', [NewsController::class, 'update'])->name('news.update');
    Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
});
