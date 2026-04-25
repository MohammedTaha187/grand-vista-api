<?php

use Illuminate\Support\Facades\Route;
use Modules\Operations\Http\Controllers\Api\V1\Admin\HousekeepingTaskController as AdminHousekeepingController;
use Modules\Operations\Http\Controllers\Api\V1\Admin\MaintenanceLogController as AdminMaintenanceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1/operations')->group(function () {

    // Admin/Staff Routes
    Route::middleware(['auth:api', 'role:admin|staff'])->prefix('admin')->group(function () {
        Route::apiResource('housekeeping', AdminHousekeepingController::class)->parameters([
            'housekeeping' => 'housekeepingTask',
        ]);
        Route::apiResource('maintenance', AdminMaintenanceController::class)->parameters([
            'maintenance' => 'maintenanceLog',
        ]);
    });

});
