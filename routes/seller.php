<?php
use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::prefix('/seller')->as('seller.')->middleware('role:2')->group(function () {
    Route::get('/', [SellerController::class, 'index'])->name('index');
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order.show/{id}', [OrderController::class, 'show'])->name('order.show');
});
