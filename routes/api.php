<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 */


use App\Http\Controllers\Api\V1\Auth\AdminAuthController;
use App\Http\Controllers\Api\V1\AuthController;
#use App\Http\Controllers\Api\V1\DeliveryController;
use App\Http\Controllers\Api\V1\DriverController;
#use App\Http\Controllers\Api\V1\Driver\DriverDashboardController;
#use App\Http\Controllers\Api\V1\Driver\DriverDeliveryController;

Route::prefix('v1')->group(function () {

    // Auth
    Route::post('admin/login', [AdminAuthController::class, 'login']);
    //Route::post('driver/login', [AuthController::class, 'sendOtp']);
    //Route::post('driver/verify-otp', [AuthController::class, 'verifyOtp']);

    Route::post('driver/login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum'])->prefix('driver')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);

        Route::get('dashboard', [DriverController::class, 'dashboard']);
        Route::get('today-count', [DriverController::class, 'todayCount']);
        Route::get('driverlist', [DriverController::class, 'driverList']);
        Route::get('undelivered_reasons', [DriverController::class, 'undeliveredReasons']);
        Route::get('deliverylist', [DriverController::class, 'deliveryList']);
        //Route::post('updatedelivery', [DriverController::class, 'updateDelivery']);   

        Route::post('/deliveries/start', [DriverController::class, 'startDelivery']);
        Route::post('/deliveries/undelivered', [DriverController::class, 'undelivered']);
        Route::post('/deliveries/delivered', [DriverController::class, 'uploadPOD']);
        Route::post('/deliveries/pass-to-driver', [DriverController::class, 'passToDriver']);
    });

    // Admin APIs
    /* Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
        Route::apiResource('deliveries', DeliveryController::class);
        Route::apiResource('drivers', DriverController::class);
    }); */

    // Driver APIs
    /* Route::middleware(['auth:sanctum'])->prefix('driver')->group(function () {
        Route::get('dashboard', [DriverDashboardController::class, 'index']);
        Route::get('deliveries', [DriverDeliveryController::class, 'index']);
        Route::post('delivery/{id}/start', [DriverDeliveryController::class, 'start']);
        Route::post('delivery/{id}/deliver', [DriverDeliveryController::class, 'deliver']);
        Route::post('delivery/{id}/undelivered', [DriverDeliveryController::class, 'undelivered']);
        Route::post('delivery/{id}/transfer', [DriverDeliveryController::class, 'transfer']);
    }); */
});
