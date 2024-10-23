<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;

Route::prefix('/admin')->as('admin.')->middleware('role:1')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::resource('admin/category', CategoryController::class);
    Route::resource('attributes', AttributeController::class);
    Route::prefix('/attribute')->as('attribute.values.')->group(function () {
        Route::get('{attribute}/values', [AttributeValueController::class, 'index'])->name('index');
        Route::post('{attribute}/values', [AttributeValueController::class, 'store'])->name('store');
        Route::get('{attribute}/values/{attributeValue}', [AttributeValueController::class, 'edit'])->name('edit');
        Route::put('/values/{attributeValue}', [AttributeValueController::class, 'update'])->name('update');
        Route::delete('{attribute}/values/{attributeValue}', [AttributeValueController::class, 'destroy'])->name('destroy');
    });
    Route::get('/dashboard', [PostController::class, 'index'])->name('admin.dashboard');
    Route::resource('roles', RoleController::class);
    Route::delete('/roles', [RoleController::class, 'destroy'])->name('roles.destroy');

});
