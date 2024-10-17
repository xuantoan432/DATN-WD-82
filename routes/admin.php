<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PostController;

// Nhóm các route với prefix 'admin'
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [PostController::class, 'index'])->name('admin.dashboard');
    Route::resource('roles', RoleController::class);
    Route::delete('/roles', [RoleController::class, 'destroy'])->name('roles.destroy');

});
