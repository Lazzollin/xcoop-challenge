<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VoucherController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VoucherUserController;
use App\Http\Controllers\Api\ApiServiceController;
use App\Models\Voucher;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('voucher', VoucherController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('bind_voucher', VoucherUserController::class);

Route::controller(ApiServiceController::class)->group(function () {
    Route::get('/user/{user}/vouchers', 'user_vouchers');
    Route::get('/check_voucher/{voucher}', 'check_voucher');
});