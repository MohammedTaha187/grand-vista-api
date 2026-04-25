<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - Global (Auth & Shared)
|--------------------------------------------------------------------------
| Module-specific routes are located in Modules/{module}/routes/api.php

*/

// Authentication Routes
Route::prefix('v1/auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    
    // Social Authentication
    Route::prefix('social/{provider}')->group(function () {
        Route::get('redirect', [AuthController::class, 'socialRedirect']);
        Route::get('callback', [AuthController::class, 'socialCallback']);
    });

    // Authenticated Auth Routes
    Route::middleware('auth:api')->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

// Root API Health Check
Route::get('/', function () {
    try {
        \Illuminate\Support\Facades\DB::connection()->getPdo();
        $dbStatus = 'connected';
    } catch (\Exception $e) {
        $dbStatus = 'disconnected';
    }

    try {
        \Illuminate\Support\Facades\Redis::connection()->ping();
        $redisStatus = 'connected';
    } catch (\Exception $e) {
        $redisStatus = 'disconnected';
    }

    return response()->json([
        'app' => config('app.name'),
        'version' => '1.0.0',
        'status' => 'online',
        'database' => $dbStatus,
        'redis' => $redisStatus,
        'php_version' => PHP_VERSION,
    ]);
});
