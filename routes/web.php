<?php

use App\Http\Controllers\Client\RefundController;
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
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Client\ProductReviewController;
// admin
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\VouchersController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AttributesNameController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ThongKeController;
use App\Http\Controllers\Admin\NewsController;

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;

use App\Http\Controllers\ChatAIController;

Route::get('/chat-ai', [ChatAIController::class, 'index']);
Route::post('/chat-ai/send', [ChatAIController::class, 'send']);



Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/brands', [HomeController::class, 'index_brands'])->name('brand');

Route::get('/search', [HomeController::class, 'search'])->name('search');
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

    Route::get('/refund/{id}', [RefundController::class, 'refund'])->name('refund');
    Route::post('/refund/refund_requests', [RefundController::class, 'refundRequests'])->name('refundRequests');
});
// sp yêu thích
Route::middleware(['auth'])->group(function () {
    Route::get('/favorites', [ProductsController::class, 'favorite'])->name('favorites');
    Route::post('/favorites', [ProductsController::class, 'storefavorite'])->name('favorites.store');
    Route::delete('/favorites/{id}', [ProductsController::class, 'destroyfavorite'])->name('favorites.destroy');
});

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
Route::get('/addresses/{id}', [AddressController::class, 'show'])->name('addresses.show')->middleware('auth');
Route::put('/addresses/{id}', [AddressController::class, 'update'])->name('addresses.update')->middleware('auth');
Route::delete('/addresses/{id}', [AddressController::class, 'destroy'])->name('addresses.destroy')->middleware('auth');
Route::post('/apply-voucher', [OrderController::class, 'applyVoucher'])->name('apply.voucher');

Route::match(['get', 'post'], '/vnpay-return', [VNPayController::class, 'handleReturn'])->name('vnpay.return');
Route::post('/vnpay-repay/{order}', [VNPayController::class, 'repayOrder'])->name('vnpay.repay');
// giỏ hàng
Route::POST('/product/addToCart', [ProductsController::class, 'addToCart'])->name('addToCart');
Route::get('product/{slug}', [ProductsController::class, 'detail'])->name('productDetail');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.view');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');

// check out
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout.view');
Route::get('/checkout/complete/{order_id?}', function ($order_id = null) {
    return view('client.checkout.complete', compact('order_id'));
})->name('checkout.complete');
Route::post('/checkout', [HomeController::class, 'checkout'])->name('checkout.post');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
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
// Đánh giá
Route::middleware(['auth'])->group(function () {
    Route::post('/products/{product}/reviews', [ProductReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{review}', [ProductReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ProductReviewController::class, 'destroy'])->name('reviews.destroy');  // Thêm route xóa
});


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
    Route::get('/vouchers/create', [VouchersController::class, 'create'])->name('vouchers.create');
    Route::post('/vouchers', [VouchersController::class, 'store'])->name('vouchers.store');
    Route::get('/vouchers/{voucher}/edit', [VouchersController::class, 'edit'])->name('vouchers.edit');
    Route::put('/vouchers/{voucher}', [VouchersController::class, 'update'])->name('vouchers.update');
    Route::delete('/vouchers/{voucher}', [VouchersController::class, 'destroy'])->name('vouchers.destroy');
    // Chatrealtime
    Route::get('/chat-rooms', [ChatController::class, 'listChatRooms'])->name('chat');
    Route::get('/{roomId}/{receiverId}', [ChatController::class, 'showChatAdmin'])
        ->name('chat.admin');
    Route::get('/chat/messages/{roomId}', [ChatController::class, 'getMessages'])->name('chat.messages');

    // Permission
    Route::prefix('permissions')
        ->as('permissions.')
        ->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('index');
            Route::get('create', [PermissionController::class, 'create'])->name('create');
            Route::get('access/{id}', [PermissionController::class, 'access'])->name('access');
            Route::post('updateGant', [PermissionController::class, 'updateGant'])->name('updateGant');
            Route::post('store', [PermissionController::class, 'store'])->name('store');
            Route::get('show/{id}', [PermissionController::class, 'show'])->name('show');
            Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [PermissionController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [PermissionController::class, 'destroy'])->name('destroy');
        });

    // Role
    Route::prefix('roles')
        ->as('roles.')
        ->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::get('create', [RoleController::class, 'create'])->name('create');
            Route::post('store', [RoleController::class, 'store'])->name('store');
            Route::get('show/{id}', [RoleController::class, 'show'])->name('show');
            Route::get('edit/{id}', [RoleController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [RoleController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [RoleController::class, 'destroy'])->name('destroy');
        });


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
            Route::post('/bulk-update-status', 'bulkUpdateStatus')->name('bulkUpdateStatus');
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
            Route::post('update-status', 'updateStatus')->name('updateStatus');
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

//chat realtime
Route::group([
    'middleware' => 'auth',
], function () {
    Route::prefix('chat')
        ->group(function () {
            Route::post('/create/{receiverId}', [ChatController::class, 'createOrRedirect'])
                ->name('chat.create');
            Route::get('/{roomId}/{receiverId}', [ChatController::class, 'showChatRoom'])
                ->name('chat.room');
            Route::post('/outChat/{roomid}', [ChatController::class, 'outChat'])
                ->name('outChat');
        });

    Route::post('/messages/send', [ChatController::class, 'sendMessage'])
        ->name('messages.send');
});
