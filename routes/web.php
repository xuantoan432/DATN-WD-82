<?php

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Seller\ChatController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\SellerRegisterController;


Route::get('/', [HomeController::class, 'index'])->name('index');



Route::get('/', function () {
    return view('client.index');
})->name('index');
Route::get('/1', function () {
    return view('client.shop');
});

Route::get('/2', function () {
    return view('client.product-info');
});



Route::get('/4', function () {
    return view('client.contact');
})->name('hihi')->middleware('auth');

Route::get('/5', function () {
    return view('client.about');
});

Route::get('/6', function () {
    return view('client.cart');
});

Route::get('/7', function () {
    return view('client.compaire');
});

Route::get('/9', function () {
    return view('client.flash-sale');
});

Route::get('/10', function () {
    return view('client.create-account');
});

Route::get('/11', function () {
    return view('client.login');
});

Route::get('/12', function () {
    return view('client.seller-sidebar');
});

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
});


