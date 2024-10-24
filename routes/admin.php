<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

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

    // Bảng Role
    Route::get('/dashboard', [PostController::class, 'index'])->name('admin.dashboard');
    Route::resource('roles', RoleController::class);
    Route::delete('/roles', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
    Route::delete('/roles', [RoleController::class, 'edit'])->name('admin.roles.edit');


    // Bảng Tags
    Route::get('/dashboard', [PostController::class, 'index'])->name('admin.dashboard');
    Route::resource('tags', TagController::class);
    Route::delete('/tags', [TagController::class, 'destroy'])->name('admin.tags.destroy');
    Route::delete('/tags', [TagController::class, 'edit'])->name('admin.tags.edit');

    //Bảng Post
    Route::get('/dashboard', [PostController::class, 'index'])->name('admin.dashboard');
    Route::resource('posts', PostController::class);
    Route::delete('/posts', [PostController::class, 'destroy'])->name('admin.posts.destroy');
    Route::delete('/posts', [PostController::class, 'edit'])->name('admin.posts.edit');

});
