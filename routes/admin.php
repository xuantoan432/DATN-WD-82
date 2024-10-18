<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->as('admin.')->group(function () {
    Route::resource('attributes', AttributeController::class);
//    Route::resource('attribute.values', AttributeValueController::class);
    Route::prefix('/attribute')->as('attribute.values.')->group(function () {
        Route::get('{attribute}/values', [AttributeValueController::class, 'index'])->name('index');
        Route::post('{attribute}/values', [AttributeValueController::class, 'store'])->name('store');
        Route::get('{attribute}/values/{attributeValue}', [AttributeValueController::class, 'edit'])->name('edit');
        Route::put('/values/{attributeValue}', [AttributeValueController::class, 'update'])->name('update');
        Route::delete('{attribute}/values/{attributeValue}', [AttributeValueController::class, 'destroy'])->name('destroy');
    });
});
