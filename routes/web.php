<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductdetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index']);

Route::get('/category/{slug}', [CategoryController::class, 'detail']);  

Route::get('/category/electronics/{slug}', [SubcategoryController::class, 'detail']);

Route::get('/category/electronics/tv/{slug}', [ProductdetailController::class, 'detail']);

Route::get('/cart-list/{slug}', [CartController::class, 'list']);

Route::get('/checkout/{slug}', [CheckoutController::class, 'checkout']);

Route::get('register', [UserController::class, 'register']);

Route::get('register1', [UserController::class, 'register1']);

Route::get('login', [UserController::class, 'login']);

Route::get('login1', [UserController::class, 'login1']);

// User Dashboard Routes Start Here:
Route::get('user/', [UserController::class, 'index']);

Route::get('user/order-history/', [UserController::class, 'history']);

Route::get('user/detail/', [UserController::class, 'detail']);

Route::get('user/settings/', [UserController::class, 'settings']);


// Vendor Dashboard Route Srart Here:

Route::prefix('vendor')->group(function(){

    Route::get('/signup', [VendorController::class, 'signup']);

    Route::get('/login', [VendorController::class, 'login']);
    
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
    Route::get('/signup', [AdminController::class, 'showRegistrationForm'])->name('signup');

    Route::post('/register', [AdminController::class, 'register'])->name('register');

    Route::get('/login', [AdminController::class, 'login'])->name('login');

    Route::post('/login', [AdminController::class, 'userlogin'])->name('userlogin');

    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    //  ++++++++ Routes with middleware ++++++++++++

Route::middleware(CheckAdmin::class)->group(function(){

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/order-detail', [AdminController::class, 'orderdetail']);

    Route::get('/add-category', [AdminController::class, 'addcategory']);

    Route::get('/view-category', [AdminController::class, 'viewcategory']);

    Route::get('/edit-category', [AdminController::class, 'editcategory']);

    Route::get('/users', [AdminController::class, 'users']);

    Route::get('/vendors', [AdminController::class, 'vendors']);

    Route::get('/orders', [AdminController::class, 'orders']);
});

});
