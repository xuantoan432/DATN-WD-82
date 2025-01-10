<?php

use App\Http\Controllers\Seller\ChatController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\AttributeController;
use App\Http\Controllers\Seller\AttributeValueController;
use App\Http\Controllers\Seller\ReviewController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\VoucherController;
use App\Http\Controllers\Seller\OrderController;
use Illuminate\Support\Facades\Route;



Route::prefix('/seller')->as('seller.')->middleware('role:2')->group(function () {

    Route::get('/', [SellerController::class, 'index'])->name('index');

    $url = [
        'products' =>  ProductController::class ,
        'attributes' => AttributeController::class ,
        'reviews' => ReviewController::class ,
    ] ;

    foreach ( $url as $name => $controller ) {
        Route::resource($name, $controller );
    }
    Route::resource('/vouchers',VoucherController::class);
    Route::prefix('/attribute')->as('attribute.values.')->group(function () {
        Route::get('{attribute}/values', [AttributeValueController::class, 'index'])->name('index');
        Route::post('{attribute}/values', [AttributeValueController::class, 'store'])->name('store');
        Route::get('{attribute}/values/{attributeValue}', [AttributeValueController::class, 'edit'])->name('edit');
        Route::put('/values/{attributeValue}', [AttributeValueController::class, 'update'])->name('update');
        Route::delete('{attribute}/values/{attributeValue}', [AttributeValueController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('/orders')->as('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('{orderDetail}/edit', [OrderController::class, 'edit'])->name('edit');
        Route::put('{orderDetail}/update', [OrderController::class, 'update'])->name('update');
    });
    Route::get('chats', [ChatController::class, 'index'])->name('chats');
    Route::get('chatPriavte/{userID}', [ChatController::class, 'chatPriavte'])->name('chatPriavte');
});
