<?php

use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\OrderDetailController;
use App\Http\Controllers\Client\ProductController;
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
use App\Http\Controllers\Client\WishlistController;
use App\Http\Controllers\Client\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/shop', [HomeController::class, 'shop'])->name('home.shop');
Route::get('/product/{product}', [ProductController::class, 'detailProduct'])->name('home.product-detail');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/9', [HomeController::class, 'flashSale'])->name('home.flash-sale');
Route::get('/terms', [HomeController::class, 'terms'])->name('home.terms');
Route::get('/12', [HomeController::class, 'sellerSidebar'])->name('home.seller-sidebar');
Route::get('/policy', [HomeController::class, 'policy'])->name('home.policy');

Route::get('posts', [PostController::class, 'showPost'])->name('posts');
Route::get('post/{id}', [PostController::class, 'postDetail'])->name('posts.detail');
Route::get('search', [PostController::class, 'search'])->name('posts.search');

Route::get('/contact', [ContactController::class, 'index'])->name('contact'); // Hiển thị form
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send'); // Xử lý dữ liệu form




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
    Route::get('/orderDetail/{code}', [OrderDetailController::class, 'orderDetail'])->name('orderDetail');
    Route::post('/orderDetail/{id}/cancel', [OrderDetailController::class, 'cancelOrderDetail'])->name('orderDetail.cancel');
    Route::post('/createAddress', [UserController::class, 'createAddress'])->name('user.address.create');
    Route::delete('/deleteAddress/{id}', [UserController::class, 'deleteAddress'])->name('user.address.delete');
    Route::resource('reviews', UserController::class);

    Route::put('/updateUser/{id}',[UserController::class,'updateUser'])->name('user.update');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::post('user/address-default/{user}', [UserController::class, 'updateAddressDefault'])->name('user.address.default');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('comments', [PostController::class, 'store'])->name('posts.comments');
    Route::post('add-cart', [CartController::class, 'addToCart'])->name('add.cart');
    Route::delete('clear-cart/{cartId}', [CartController::class, 'clearCart'])->name('clear.cart');
    Route::get('cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::get('checkout', [OrderController::class, 'showCheckout'])->name('checkout.show');


    Route::get('/wishlist', [WishlistController::class, 'listWishlist'])->name('wishlist.show');
    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::post('/wishlist/remove/{id}', [WishlistController::class, 'removeWishlist'])->name('wishlist.remove');
    Route::post('/wishlist/clean', [WishlistController::class, 'cleanWishlist'])->name('wishlist.clean');
    Route::get('checkout/{user}', [OrderController::class, 'showCheckout'])->name('checkout.show');
    Route::post('order/create', [OrderController::class, 'createOrder'])->name('order.create');
    Route::get('order/check', [OrderController::class, 'checkOrderMomo'])->name('order.check');
    Route::get('thank', [OrderController::class, 'thank'])->name('thank');

    Route::post('rating/{user}', [OrderController::class, 'rating'])->name('rating');

    Route::post('/shop/save', [UserController::class, 'saveOrUpdateShop'])->name('shop.save');
});


