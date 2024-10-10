<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Seller\ChatController;
use App\Http\Controllers\Seller\SellerController;
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

Route::get('/' , [PostController::class,'index'])->name('admin');
Route::get('/seller' , [SellerController::class,'index'])->name('seller');
Route::get('/seller/chat' , [ChatController::class,'index'])->name('chat');
