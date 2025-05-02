<?php

use App\Http\Middleware\AdminSessionTokenCheck;
use App\Http\Middleware\SessionGuardMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckUserSession;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductdetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Emailcontroller;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\CheckUserType;
use Illuminate\Routing\Route as RoutingRoute;

Route::get('/', function () {
    return view('welcome');
});

// email verifiaction 


Route::get('send-email', [Emailcontroller::class, 'sendEmail']);
Route::get('/mailform', action: [Emailcontroller::class, 'mailform']);
Route::post('/mailform', action: [Emailcontroller::class, 'sendContactEmail'])->name('contact');

Route::get('email-reverify', [AdminController::class, 'emailr everify'])->name('show.emailreverify');
Route::post('/resendOtp', [AdminController::class, 'resendOtp'])->name('resendOtp');
Route::get('mail/verify-otp/{user_email}', [Emailcontroller::class, 'showOtpForm'])->name('verifyOtpForm');
Route::post('mail/verify-otp', [Emailcontroller::class, 'verifyOtp'])->name('verifyOtp');
Route::get('/payment', [PaymentController::class, 'index']);
Route::post('/payment', [PaymentController::class, 'payment'])->name('payment');
Route::post('/verify', [App\Http\Controllers\PaymentController::class, 'verify'])->name('payment.verify');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/showverifyotp/{user_email}', [UserController::class, 'showverifyotp'])->name('user.show.verifyotp');
Route::get('/category/{slug}', [CategoryController::class, 'detail']);
Route::get('/category/electronics/{slug}', [SubcategoryController::class, 'detail']);
Route::get('/category/electronics/tv/{slug}', [ProductdetailController::class, 'detail']);
Route::get('/cart-list/{slug}', [CartController::class, 'list']);
Route::get('/checkout/{slug}', [CheckoutController::class, 'checkout']);
Route::get('register', [UserController::class, 'showregister']);
Route::post('register', [UserController::class, 'register'])->name('user.register');
Route::get('register1', [UserController::class, 'register1']);
Route::get('login', [UserController::class, 'login'])->name('login');
Route::get('/logout-user', [UserController::class, 'logout']);
Route::get('login1', [UserController::class, 'login1']);

// User Dashboard Routes Start Here:

Route::post('login', [UserController::class, 'verifylogin'])->name('user.verifylogin');
Route::middleware([CheckUserType::class])->group(function () {

    // This route will be available only if user is logged in and has role 'user'
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::post('/update-profile', [UserController::class, 'updateprofile'])->name('update.profile');
    Route::get('user/order-history/', [UserController::class, 'history']);
    Route::get('user/detail/', [UserController::class, 'detail']);
    Route::get('user/settings/', [UserController::class, 'settings'])->name('user.setting');
});

// Vendor Dashboard Route Srart Here:

Route::prefix('vendor')->group(function () {

    Route::get('/signup', [VendorController::class, 'signup']);
    Route::get('/login', [VendorController::class, 'login'])->name('vendor.login');
    Route::get('/forget', [VendorController::class, 'forget']);
    Route::get('/dashboard', [VendorController::class, 'index']);
    Route::get('/add-product', [VendorController::class, 'addproduct']);
    Route::get('/view-product', [VendorController::class, 'viewproduct']);
    Route::get('/edit-product', [VendorController::class, 'editproduct']);
    Route::get('/orders', [VendorController::class, 'orders']);
    Route::get('/order-detail', [VendorController::class, 'orderdetail']);
    Route::get('/users', [VendorController::class, 'users']);
    Route::get('/profile', [VendorController::class, 'profile']);
});

// +++++++++Admin Dashboard Start Here++++++++++++++

Route::prefix('admin')->group(function () {

    // ++++++++++++ Routes without middleware +++++++++++++++
    Route::post('verify-otp', [AdminController::class, 'verifyOTP'])->name('verifyotp');
    Route::get('/signup', [AdminController::class, 'showRegistrationForm'])->name('signup');
    Route::post('/register', [AdminController::class, 'register'])->name('register');
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'adminlogin'])->name('userlogin');
    Route::match(['get', 'post'], '/logout', [AdminController::class, 'logout'])->name('logout');

    //  ++++++++ Routes with middleware ++++++++++++
    Route::middleware([CheckAdmin::class, CheckUserSession::class, SessionGuardMiddleware::class, AdminSessionTokenCheck::class])->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/order-detail', [AdminController::class, 'orderdetail']);

        // category route
        Route::get('/add-category', [CategoryController::class, 'addcategory'])->name('add.category');
        Route::post('/insert-category', [CategoryController::class, 'insertcategory'])->name('insert.category');
        Route::get('/fetch-category', [CategoryController::class, 'fetchcategory'])->name('fecth.category');
        Route::get('/view-category', [AdminController::class, 'viewcategory']);
        Route::post('/update-category-status', [CategoryController::class, 'categorystatus'])->name('update.category.status');
        Route::post('/delete-category', [CategoryController::class, 'deletecategory'])->name('delete.category');

        // sub category route 
        Route::get('/subcategory-show', [SubcategoryController::class, 'showSubcategory'])->name('subcategory.showSubcategory');
        Route::post('/subcategory-store', [SubcategoryController::class, 'addSubcategory'])->name('subcategory.store');
        Route::get('/subcategory/fetch', [SubcategoryController::class, 'fetchsubcategory'])->name('subcategory.fetch');
        Route::post('/subcategory-changestatus', [SubcategoryController::class, 'changestatus'])->name('subcategory.changestatus');
        Route::post('/delete-subcategory', [SubcategoryController::class, 'deletesubcategory'])->name('delete.subcategory');

        Route::get('/edit-category', [AdminController::class, 'editcategory']);
        Route::get('/users', [AdminController::class, 'users']);
        Route::post('/users-status', [AdminController::class, 'block_unblock_user'])->name('users.status');
        Route::get('/vendors', [AdminController::class, 'vendors']);

        // product route 
        Route::get('/add-product', [ProductdetailController::class, 'addproduct'])->name('add.product');
        Route::get('/view-product', [ProductdetailController::class, 'viewproduct'])->name('view.product');
        Route::get('/get-subcategories', [ProductdetailController::class, 'getSubcategories'])->name('get.subcategory');


        Route::get('/orders', [AdminController::class, 'orders']);
    });
});
