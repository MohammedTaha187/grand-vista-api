<?php

use Illuminate\Support\Facades\Route;
use Modules\Hotel\Http\Controllers\Api\V1\Admin\AmenityController as AdminAmenityController;
use Modules\Hotel\Http\Controllers\Api\V1\Admin\BookingController as AdminBookingController;
use Modules\Hotel\Http\Controllers\Api\V1\Admin\RoomController as AdminRoomController;
use Modules\Hotel\Http\Controllers\Api\V1\Admin\RoomTypeController as AdminRoomTypeController;
use Modules\Hotel\Http\Controllers\Api\V1\Admin\PaymentController as AdminPaymentController;
use Modules\Hotel\Http\Controllers\Api\V1\Admin\InvoiceController as AdminInvoiceController;
use Modules\Hotel\Http\Controllers\Api\V1\Admin\ReviewController as AdminReviewController;
use Modules\Hotel\Http\Controllers\Api\V1\Client\RoomTypeController as ClientRoomTypeController;
use Modules\Hotel\Http\Controllers\Api\V1\Client\BookingController as ClientBookingController;
use Modules\Hotel\Http\Controllers\Api\V1\Client\ReviewController as ClientReviewController;
use Modules\Hotel\Http\Controllers\Api\V1\Admin\DashboardController as AdminDashboardController;
use Modules\Hotel\Http\Controllers\Api\V1\Admin\BookingAddonController as AdminBookingAddonController;
use Modules\Hotel\Http\Controllers\Api\V1\Admin\BookingRoomController as AdminBookingRoomController;
use Modules\Hotel\Http\Controllers\Api\V1\Admin\InvoiceItemController as AdminInvoiceItemController;
use Modules\Hotel\Http\Controllers\Api\V1\Admin\RoomAvailabilityController as AdminRoomAvailabilityController;
use Modules\Hotel\Http\Controllers\Api\V1\Admin\FavoriteController as AdminFavoriteController;
use Modules\Hotel\Http\Controllers\Api\V1\Admin\GuestPreferenceController as AdminGuestPreferenceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1/hotel')->group(function () {

    // Admin Routes
    Route::middleware(['auth:api', 'role:admin', 'throttle:60,1'])->prefix('admin')->group(function () {
        Route::apiResource('amenities', AdminAmenityController::class);
        Route::apiResource('room-types', AdminRoomTypeController::class);
        Route::apiResource('rooms', AdminRoomController::class);
        Route::apiResource('bookings', AdminBookingController::class);
        Route::prefix('bookings/{booking}')->group(function () {
            Route::post('confirm', [AdminBookingController::class, 'confirm']);
            Route::post('check-in', [AdminBookingController::class, 'checkIn']);
            Route::post('check-out', [AdminBookingController::class, 'checkOut']);
            Route::post('cancel', [AdminBookingController::class, 'cancel']);
            Route::post('refund', [AdminBookingController::class, 'refund']);
        });
        Route::apiResource('payments', AdminPaymentController::class);
        Route::apiResource('invoices', AdminInvoiceController::class);
        Route::apiResource('reviews', AdminReviewController::class);

        // Ancillary Resources
        Route::apiResource('booking-addons', AdminBookingAddonController::class);
        Route::apiResource('booking-rooms', AdminBookingRoomController::class);
        Route::apiResource('invoice-items', AdminInvoiceItemController::class);
        Route::apiResource('room-availabilities', AdminRoomAvailabilityController::class);
        Route::apiResource('favorites', AdminFavoriteController::class);
        Route::apiResource('guest-preferences', AdminGuestPreferenceController::class);
        
        // Dashboard & Analytics
        Route::prefix('dashboard')->group(function () {
            Route::get('insights', [AdminDashboardController::class, 'index']);
            Route::get('occupancy', [AdminDashboardController::class, 'occupancy']);
            Route::get('revenue', [AdminDashboardController::class, 'revenue']);
            Route::get('maintenance', [AdminDashboardController::class, 'maintenance']);
        });
    });

    // Client Routes (Public & Private)
    Route::prefix('client')->middleware('throttle:100,1')->group(function () {
        // Public
        Route::get('room-types', [ClientRoomTypeController::class, 'index']);
        Route::get('room-types/{id}', [ClientRoomTypeController::class, 'show']);
        Route::get('reviews', [ClientReviewController::class, 'index']);

        // Private (Authenticated)
        Route::middleware(['auth:api'])->group(function () {
            Route::apiResource('bookings', ClientBookingController::class);
            Route::apiResource('reviews', ClientReviewController::class)->except(['index']);

            // Payments
            Route::prefix('payments')->group(function () {
                Route::post('pay', [\Modules\Hotel\app\Http\Controllers\Api\V1\Client\PaymentController::class, 'pay']);
                Route::get('callback/{method}', [\Modules\Hotel\app\Http\Controllers\Api\V1\Client\PaymentController::class, 'callback']);
            });
        });
    });

});
