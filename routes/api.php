<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 */


use App\Http\Controllers\Api\V1\Auth\AdminAuthController;
use App\Http\Controllers\Api\V1\Auth\DriverAuthController;
use App\Http\Controllers\Api\V1\Admin\DeliveryController;
use App\Http\Controllers\Api\V1\Admin\DriverController;
use App\Http\Controllers\Api\V1\Driver\DriverDashboardController;
use App\Http\Controllers\Api\V1\Driver\DriverDeliveryController;

Route::prefix('v1')->group(function () {

    // Auth
    Route::post('admin/login', [AdminAuthController::class, 'login']);
    Route::post('driver/login', [DriverAuthController::class, 'sendOtp']);
    Route::post('driver/verify-otp', [DriverAuthController::class, 'verifyOtp']);

    // Admin APIs
    Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
        Route::apiResource('deliveries', DeliveryController::class);
        Route::apiResource('drivers', DriverController::class);
    });

    // Driver APIs
    Route::middleware(['auth:sanctum'])->prefix('driver')->group(function () {
        Route::get('dashboard', [DriverDashboardController::class, 'index']);
        Route::get('deliveries', [DriverDeliveryController::class, 'index']);
        Route::post('delivery/{id}/start', [DriverDeliveryController::class, 'start']);
        Route::post('delivery/{id}/deliver', [DriverDeliveryController::class, 'deliver']);
        Route::post('delivery/{id}/undelivered', [DriverDeliveryController::class, 'undelivered']);
        Route::post('delivery/{id}/transfer', [DriverDeliveryController::class, 'transfer']);
    });
});
