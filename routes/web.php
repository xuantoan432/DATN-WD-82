<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('client.index');
});
Route::get('/1', function () {
    return view('client.shop');
});

Route::get('/2', function () {
    return view('client.product-info');
});

Route::get('/3', function () {
    return view('client.user-profile');
});

Route::get('/4', function () {
    return view('client.contact');
});

Route::get('/5', function () {
    return view('client.about');
});

Route::get('/6', function () {
    return view('client.cart');
});

Route::get('/7', function () {
    return view('client.compaire');
});

Route::get('/8', function () {
    return view('client.become-vendor');
});

Route::get('/9', function () {
    return view('client.flash-sale');
});

Route::get('/10', function () {
    return view('client.create-account');
});

Route::get('/11', function () {
    return view('client.login');
});

Route::get('/12', function () {
    return view('client.seller-sidebar');
});
