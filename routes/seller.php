<?php

use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;



Route::prefix('/seller')->as('seller.')->middleware('role:2')->group(function () {

    Route::get('/', [SellerController::class, 'index'])->name('index');

    $url = [
        'products' =>  ProductController::class ,
    ] ;

    foreach ( $url as $name => $controller ) {
        Route::resource($name, $controller );
    }

});
