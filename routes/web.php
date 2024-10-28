<?php

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Seller\ChatController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\SellerRegisterController;





Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/1', [HomeController::class, 'shop'])->name('home.shop');
Route::get('/2', [HomeController::class, 'productInfo'])->name('home.product-info');
Route::get('/4', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/5', [HomeController::class, 'about'])->name('home.about');
Route::get('/6', [HomeController::class, 'cart'])->name('home.cart');
Route::get('/7', [HomeController::class, 'compare'])->name('home.compare');
Route::get('/8', [HomeController::class, 'becomeVendor'])->name('home.become-vendor');
Route::get('/9', [HomeController::class, 'flashSale'])->name('home.flash-sale');
Route::get('/10', [HomeController::class, 'createAccount'])->name('home.create-account');
Route::get('/11', [HomeController::class, 'login'])->name('home.login');
Route::get('/12', [HomeController::class, 'sellerSidebar'])->name('home.seller-sidebar');

Route::get('posts', [PostController::class, 'showPost'])->name('posts');
Route::get('post/{id}', [PostController::class, 'postDetail'])->name('posts.detail');
Route::get('search', [PostController::class, 'search'])->name('posts.search');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLogInForm'])->name('login');
    Route::post('login', [LoginController::class, 'logIn']);
    Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register');
    Route::prefix('auth')->as('auth.')->group(function () {
        Route::get('/forgot', [ForgotPasswordController::class,'showFormForgotPassword'])->name('forgot');
        Route::post('/forgot', [ForgotPasswordController::class,'sendMailPassword'])->name('forgot');
        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm']);
        Route::put('/reset-password/{token}', [ResetPasswordController::class, 'reset'])->name('reset');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('register/seller', [SellerRegisterController::class, 'showRegistrationForm'])->name('register.seller');
    Route::post('register/seller', [SellerRegisterController::class, 'register']);
    Route::get('/logout', [LoginController::class,'logout'])->name('logout');
    Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('dashboard');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('comments', [PostController::class, 'store'])->name('posts.comments');
});


