<?php

use Illuminate\Support\Facades\Route;
use Modules\Cms\Http\Controllers\Api\V1\Admin\OfferController as AdminOfferController;
use Modules\Cms\Http\Controllers\Api\V1\Admin\BlogPostController as AdminBlogPostController;
use Modules\Cms\Http\Controllers\Api\V1\Admin\GalleryController as AdminGalleryController;
use Modules\Cms\Http\Controllers\Api\V1\Admin\FaqController as AdminFaqController;
use Modules\Cms\Http\Controllers\Api\V1\Admin\TestimonialController as AdminTestimonialController;
use Modules\Cms\Http\Controllers\Api\V1\Admin\ContactMessageController as AdminContactMessageController;

use Modules\Cms\Http\Controllers\Api\V1\Client\OfferController as ClientOfferController;
use Modules\Cms\Http\Controllers\Api\V1\Client\BlogPostController as ClientBlogPostController;
use Modules\Cms\Http\Controllers\Api\V1\Client\GalleryController as ClientGalleryController;
use Modules\Cms\Http\Controllers\Api\V1\Client\FaqController as ClientFaqController;
use Modules\Cms\Http\Controllers\Api\V1\Client\TestimonialController as ClientTestimonialController;
use Modules\Cms\Http\Controllers\Api\V1\Client\ContactMessageController as ClientContactMessageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1/cms')->group(function () {

    // Admin Routes
    Route::middleware(['auth:api', 'role:admin'])->prefix('admin')->group(function () {
        Route::apiResource('offers', AdminOfferController::class);
        Route::apiResource('blog-posts', AdminBlogPostController::class);
        Route::apiResource('galleries', AdminGalleryController::class);
        Route::apiResource('faqs', AdminFaqController::class);
        Route::apiResource('testimonials', AdminTestimonialController::class);
        Route::apiResource('contact-messages', AdminContactMessageController::class);
    });

    // Client Routes
    Route::prefix('client')->group(function () {
        Route::get('offers', [ClientOfferController::class, 'index']);
        Route::get('blog-posts', [ClientBlogPostController::class, 'index']);
        Route::get('blog-posts/{id}', [ClientBlogPostController::class, 'show']);
        Route::get('galleries', [ClientGalleryController::class, 'index']);
        Route::get('faqs', [ClientFaqController::class, 'index']);
        Route::get('testimonials', [ClientTestimonialController::class, 'index']);
        Route::post('contact-messages', [ClientContactMessageController::class, 'store']);
    });

});
