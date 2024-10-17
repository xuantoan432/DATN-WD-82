<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SellerRegisterController;
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
// Route::prefix('auth.')->as('auth')->group(function () {

// });

Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');

Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::get('register/seller', [SellerRegisterController::class, 'showRegistrationForm'])->name('register.seller');
Route::post('register/seller', [SellerRegisterController::class, 'register']);
