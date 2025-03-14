<?php



use App\Http\Controllers\Admin\AttributesValuesController;
use App\Http\Controllers\Client\AddressController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\Payment\VNPayController;
use Illuminate\Support\Facades\Route;
// client
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductsController;
use App\Http\Controllers\Client\LoginRegisterController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
});

// router phan tin tuc

Route::get('/news', [CreateNewsController::class, 'index']);
Route::get('/news/{id}', [CreateNewsController::class, 'show'])->name('news.show');

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

Route::get('/vnpay-return',[VNPayController::class,'handleReturn'])->name('vnpay.return');
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
    // Route::get("/qldonhang", [Controller::class, 'donhang']);
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
    Route::delete('/orders/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');
    Route::get('/orders/{id}', [OrdersController::class, 'show'])->name('orders.show');
    Route::get('orders/{id}/edit', [OrdersController::class, 'edit'])->name('orders.edit');
    Route::post('orders/{id}', [OrdersController::class, 'update'])->name('orders.update');
    Route::post('/orders/{id}/update', [OrdersController::class, 'update'])->name('orders.update');

    //Thống Kê
    Route::get('/thongke', [ThongKeController::class, 'statistical'])->name('thongke.statistical');
});
