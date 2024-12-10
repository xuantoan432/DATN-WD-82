<?php

use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\AttributeController;
use App\Http\Controllers\Seller\AttributeValueController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\VoucherController;
use Illuminate\Support\Facades\Route;



Route::prefix('/seller')->as('seller.')->middleware('role:2')->group(function () {

    Route::get('/', [SellerController::class, 'index'])->name('index');

    $url = [
        'products' =>  ProductController::class ,
        'attributes' => AttributeController::class ,
    ] ;

    foreach ( $url as $name => $controller ) {
        Route::resource($name, $controller );
    }
    Route::resource('/vouchers',VoucherController::class);
    Route::resource('attributes', AttributeController::class);
    Route::prefix('/attribute')->as('attribute.values.')->group(function () {
        Route::get('{attribute}/values', [AttributeValueController::class, 'index'])->name('index');
        Route::post('{attribute}/values', [AttributeValueController::class, 'store'])->name('store');
        Route::get('{attribute}/values/{attributeValue}', [AttributeValueController::class, 'edit'])->name('edit');
        Route::put('/values/{attributeValue}', [AttributeValueController::class, 'update'])->name('update');
        Route::delete('{attribute}/values/{attributeValue}', [AttributeValueController::class, 'destroy'])->name('destroy');
    });
});
