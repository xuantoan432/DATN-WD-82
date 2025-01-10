<?php


use App\Http\Controllers\API\ChatPrivateController;
use App\Http\Controllers\API\ImageUploadController;
use App\Http\Controllers\API\ProductApproveController;

use App\Http\Controllers\Client\API\AddressController;

use App\Http\Controllers\Client\API\AddToCartController;
use App\Http\Controllers\API\AttributeController;
use App\Http\Controllers\API\AttributeValueController;
use App\Http\Controllers\Client\API\OrderController;
use App\Http\Controllers\Client\API\VoucherController;
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
Route::resource('attribute', AttributeController::class);
Route::resource('attributevalue', AttributeValueController::class);

Route::prefix('admin')->group(function () {
    Route::resource('admin-product' , ProductApproveController::class);
});

Route::post('voucher/apply', [VoucherController::class, 'applyVoucher']);
Route::post('address/create', [AddressController::class, 'create']);
Route::post('tinyMCE/upload', [ImageUploadController::class, 'upload']);
Route::get('p', [AddressController::class, 'getAllProvinces']);
Route::get('p/{province_id}', [AddressController::class, 'getDistrictByProvince']);
Route::get('d/{district_id}', [AddressController::class, 'getWardByDistrict']);

Route::post('/post-message-private/{userId}', [ChatPrivateController::class, 'messagePrivate'])->name('messagePrivate');
Route::get('/list-message-private', [ChatPrivateController::class, 'listMessagePrivate'])->name('listMessagePrivate');

