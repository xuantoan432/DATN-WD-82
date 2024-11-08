<?php

use App\Http\Controllers\Client\API\AddToCartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('check-variant', [AddToCartController::class, 'checkVariant']);
Route::get('check-quantity', [AddToCartController::class, 'checkQuantity']);
Route::delete('remove-from-cart', [AddToCartController::class, 'deleteItemCart']);
