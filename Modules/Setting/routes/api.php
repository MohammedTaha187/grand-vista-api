<?php

use Illuminate\Support\Facades\Route;
use Modules\Setting\Http\Controllers\Api\V1\Admin\HotelSettingController as AdminSettingController;
use Modules\Setting\Http\Controllers\Api\V1\Admin\ActivityLogController as AdminActivityController;
use Modules\Setting\Http\Controllers\Api\V1\Client\HotelSettingController as ClientSettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1/settings')->group(function () {

    // Admin Routes
    Route::middleware(['auth:api', 'role:admin'])->prefix('admin')->group(function () {
        Route::apiResource('hotel-settings', AdminSettingController::class);
        Route::apiResource('activity-logs', AdminActivityController::class);
    });

    // Client/Public Routes
    Route::prefix('client')->group(function () {
        Route::get('public-settings', [ClientSettingController::class, 'index']); // For things like hotel name, logo, contact
    });

});
