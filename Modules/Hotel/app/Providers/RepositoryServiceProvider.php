<?php

namespace Modules\Hotel\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Hotel\Repositories\Amenity\AmenityRepository;
use Modules\Hotel\Repositories\Amenity\Contracts\AmenityRepositoryInterface;
use Modules\Hotel\Repositories\Room\Contracts\RoomRepositoryInterface;
use Modules\Hotel\Repositories\Room\RoomRepository;
use Modules\Hotel\Repositories\RoomType\Contracts\RoomTypeRepositoryInterface;
use Modules\Hotel\Repositories\RoomType\RoomTypeRepository;
use Modules\Hotel\Services\Amenity\AmenityService;
use Modules\Hotel\Services\Amenity\Contracts\AmenityServiceInterface;
use Modules\Hotel\Services\Room\Contracts\RoomServiceInterface;
use Modules\Hotel\Services\Room\RoomService;
use Modules\Hotel\Services\RoomType\Contracts\RoomTypeServiceInterface;
use Modules\Hotel\Services\RoomType\RoomTypeService;
use Modules\Hotel\Services\Dashboard\Contracts\DashboardServiceInterface;
use Modules\Hotel\Services\Dashboard\DashboardService;

// Bookings
use Modules\Hotel\Repositories\Booking\Contracts\BookingRepositoryInterface;
use Modules\Hotel\Repositories\Booking\BookingRepository;
use Modules\Hotel\Services\Booking\Contracts\BookingServiceInterface;
use Modules\Hotel\Services\Booking\BookingService;

use Modules\Hotel\Repositories\BookingRoom\Contracts\BookingRoomRepositoryInterface;
use Modules\Hotel\Repositories\BookingRoom\BookingRoomRepository;
use Modules\Hotel\Services\BookingRoom\Contracts\BookingRoomServiceInterface;
use Modules\Hotel\Services\BookingRoom\BookingRoomService;

use Modules\Hotel\Repositories\BookingAddon\Contracts\BookingAddonRepositoryInterface;
use Modules\Hotel\Repositories\BookingAddon\BookingAddonRepository;
use Modules\Hotel\Services\BookingAddon\Contracts\BookingAddonServiceInterface;
use Modules\Hotel\Services\BookingAddon\BookingAddonService;

use Modules\Hotel\Repositories\RoomAvailability\Contracts\RoomAvailabilityRepositoryInterface;
use Modules\Hotel\Repositories\RoomAvailability\RoomAvailabilityRepository;
use Modules\Hotel\Services\RoomAvailability\Contracts\RoomAvailabilityServiceInterface;
use Modules\Hotel\Services\RoomAvailability\RoomAvailabilityService;

// Payments & Invoices
use Modules\Hotel\Repositories\Payment\Contracts\PaymentRepositoryInterface;
use Modules\Hotel\Repositories\Payment\PaymentRepository;
use Modules\Hotel\Services\Payment\Contracts\PaymentServiceInterface;
use Modules\Hotel\Services\Payment\PaymentService;

use Modules\Hotel\Repositories\Invoice\Contracts\InvoiceRepositoryInterface;
use Modules\Hotel\Repositories\Invoice\InvoiceRepository;
use Modules\Hotel\Services\Invoice\Contracts\InvoiceServiceInterface;
use Modules\Hotel\Services\Invoice\InvoiceService;

use Modules\Hotel\Repositories\InvoiceItem\Contracts\InvoiceItemRepositoryInterface;
use Modules\Hotel\Repositories\InvoiceItem\InvoiceItemRepository;
use Modules\Hotel\Services\InvoiceItem\Contracts\InvoiceItemServiceInterface;
use Modules\Hotel\Services\InvoiceItem\InvoiceItemService;

// Guest Experience
use Modules\Hotel\Repositories\Review\Contracts\ReviewRepositoryInterface;
use Modules\Hotel\Repositories\Review\ReviewRepository;
use Modules\Hotel\Services\Review\Contracts\ReviewServiceInterface;
use Modules\Hotel\Services\Review\ReviewService;

use Modules\Hotel\Repositories\Favorite\Contracts\FavoriteRepositoryInterface;
use Modules\Hotel\Repositories\Favorite\FavoriteRepository;
use Modules\Hotel\Services\Favorite\Contracts\FavoriteServiceInterface;
use Modules\Hotel\Services\Favorite\FavoriteService;

use Modules\Hotel\Repositories\GuestPreference\Contracts\GuestPreferenceRepositoryInterface;
use Modules\Hotel\Repositories\GuestPreference\GuestPreferenceRepository;
use Modules\Hotel\Services\GuestPreference\Contracts\GuestPreferenceServiceInterface;
use Modules\Hotel\Services\GuestPreference\GuestPreferenceService;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(AmenityRepositoryInterface::class, AmenityRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(RoomTypeRepositoryInterface::class, RoomTypeRepository::class);
        
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
        $this->app->bind(BookingRoomRepositoryInterface::class, BookingRoomRepository::class);
        $this->app->bind(BookingAddonRepositoryInterface::class, BookingAddonRepository::class);
        $this->app->bind(RoomAvailabilityRepositoryInterface::class, RoomAvailabilityRepository::class);

        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
        $this->app->bind(InvoiceItemRepositoryInterface::class, InvoiceItemRepository::class);

        $this->app->bind(ReviewRepositoryInterface::class, ReviewRepository::class);
        $this->app->bind(FavoriteRepositoryInterface::class, FavoriteRepository::class);
        $this->app->bind(GuestPreferenceRepositoryInterface::class, GuestPreferenceRepository::class);

        // Services
        $this->app->bind(AmenityServiceInterface::class, AmenityService::class);
        $this->app->bind(RoomServiceInterface::class, RoomService::class);
        $this->app->bind(RoomTypeServiceInterface::class, RoomTypeService::class);
        
        $this->app->bind(BookingServiceInterface::class, BookingService::class);
        $this->app->bind(BookingRoomServiceInterface::class, BookingRoomService::class);
        $this->app->bind(BookingAddonServiceInterface::class, BookingAddonService::class);
        $this->app->bind(RoomAvailabilityServiceInterface::class, RoomAvailabilityService::class);

        $this->app->bind(PaymentServiceInterface::class, PaymentService::class);
        $this->app->bind(InvoiceServiceInterface::class, InvoiceService::class);
        $this->app->bind(InvoiceItemServiceInterface::class, InvoiceItemService::class);

        $this->app->bind(ReviewServiceInterface::class, ReviewService::class);
        $this->app->bind(FavoriteServiceInterface::class, FavoriteService::class);
        $this->app->bind(GuestPreferenceServiceInterface::class, GuestPreferenceService::class);
        $this->app->bind(DashboardServiceInterface::class, DashboardService::class);
    }
}
