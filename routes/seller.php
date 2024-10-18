<?php
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('/seller' , [SellerController::class,'index'])->name('seller');
