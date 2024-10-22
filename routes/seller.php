<?php
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::prefix('/seller')->as('seller.')->middleware('role:2')->group(function () {
    Route::get('/', [SellerController::class, 'index'])->name('index');
});
