<?php

use App\Http\Controllers\Seller\AttributeController;
use App\Http\Controllers\Seller\AttributeValueController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::prefix('/seller')->as('seller.')->middleware('role:2')->group(function () {
    Route::get('/', [SellerController::class, 'index'])->name('index');
    Route::resource('attributes', AttributeController::class);
    Route::prefix('/attribute')->as('attribute.values.')->group(function () {
        Route::get('{attribute}/values', [AttributeValueController::class, 'index'])->name('index');
        Route::post('{attribute}/values', [AttributeValueController::class, 'store'])->name('store');
        Route::get('{attribute}/values/{attributeValue}', [AttributeValueController::class, 'edit'])->name('edit');
        Route::put('/values/{attributeValue}', [AttributeValueController::class, 'update'])->name('update');
        Route::delete('{attribute}/values/{attributeValue}', [AttributeValueController::class, 'destroy'])->name('destroy');
    });
});
