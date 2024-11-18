<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserApprovalController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Admin\VoucherController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->as('admin.')->middleware('role:1')->group(function () {  
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('/category',CategoryController::class);
    Route::resource('/vouchers',VoucherController::class);
    Route::get('/seller-approvals', [AdminUserApprovalController::class, 'index'])->name('admin.seller-approval');
    Route::get('/seller-approvals', [AdminUserApprovalController::class, 'index'])->name('seller-approval');
    Route::post('/seller-approve/{id}', [AdminUserApprovalController::class, 'approve'])->name('seller-approve');
    Route::post('/seller-reject/{id}', [AdminUserApprovalController::class, 'reject'])->name('seller-reject');

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

    Route::resource('users',\App\Http\Controllers\Admin\UserController::class);

});
