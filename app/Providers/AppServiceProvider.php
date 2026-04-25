<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Modules\Cms\Models\BlogPost;
use Modules\Cms\Models\ContactMessage;
use Modules\Cms\Models\Faq;
use Modules\Cms\Models\Gallery;
use Modules\Cms\Models\Offer;
use Modules\Cms\Models\Testimonial;
use Modules\Cms\Policies\BlogPost\BlogPostPolicy;
use Modules\Cms\Policies\ContactMessage\ContactMessagePolicy;
use Modules\Cms\Policies\Faq\FaqPolicy;
use Modules\Cms\Policies\Gallery\GalleryPolicy;
use Modules\Cms\Policies\Offer\OfferPolicy;
use Modules\Cms\Policies\Testimonial\TestimonialPolicy;
use Modules\Hotel\Models\Amenity;
use Modules\Hotel\Models\Booking;
use Modules\Hotel\Models\BookingAddon;
use Modules\Hotel\Models\BookingRoom;
use Modules\Hotel\Models\Favorite;
use Modules\Hotel\Models\GuestPreference;
use Modules\Hotel\Models\Invoice;
use Modules\Hotel\Models\InvoiceItem;
use Modules\Hotel\Models\Payment;
use Modules\Hotel\Models\Review;
use Modules\Hotel\Models\Room;
use Modules\Hotel\Models\RoomAvailability;
use Modules\Hotel\Models\RoomType;
use Modules\Hotel\Policies\Amenity\AmenityPolicy;
use Modules\Hotel\Policies\Booking\BookingPolicy;
use Modules\Hotel\Policies\BookingAddon\BookingAddonPolicy;
use Modules\Hotel\Policies\BookingRoom\BookingRoomPolicy;
use Modules\Hotel\Policies\Favorite\FavoritePolicy;
use Modules\Hotel\Policies\GuestPreference\GuestPreferencePolicy;
use Modules\Hotel\Policies\Invoice\InvoicePolicy;
use Modules\Hotel\Policies\InvoiceItem\InvoiceItemPolicy;
use Modules\Hotel\Policies\Payment\PaymentPolicy;
use Modules\Hotel\Policies\Review\ReviewPolicy;
use Modules\Hotel\Policies\Room\RoomPolicy;
use Modules\Hotel\Policies\RoomAvailability\RoomAvailabilityPolicy;
use Modules\Hotel\Policies\RoomType\RoomTypePolicy;
use Modules\Operations\Models\HousekeepingTask;
use Modules\Operations\Models\MaintenanceLog;
use Modules\Operations\Policies\HousekeepingTask\HousekeepingTaskPolicy;
use Modules\Operations\Policies\MaintenanceLog\MaintenanceLogPolicy;
use Modules\Setting\Models\ActivityLog;
use Modules\Setting\Models\HotelSetting;
use Modules\Setting\Policies\ActivityLog\ActivityLogPolicy;
use Modules\Setting\Policies\HotelSetting\HotelSettingPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(function (string $modelName): string {
            if (Str::startsWith($modelName, 'Modules\\')) {
                $module = Str::between($modelName, 'Modules\\', '\\Models\\');
                $modelClass = class_basename($modelName);

                return "Modules\\{$module}\\Database\\Factories\\{$modelClass}\\{$modelClass}Factory";
            }

            $appNamespace = app()->getNamespace();

            $modelName = Str::startsWith($modelName, $appNamespace.'Models\\')
                ? Str::after($modelName, $appNamespace.'Models\\')
                : Str::after($modelName, $appNamespace);

            return 'Database\\Factories\\'.$modelName.'Factory';
        });

        foreach ([
            BlogPost::class => BlogPostPolicy::class,
            ContactMessage::class => ContactMessagePolicy::class,
            Faq::class => FaqPolicy::class,
            Gallery::class => GalleryPolicy::class,
            Offer::class => OfferPolicy::class,
            Testimonial::class => TestimonialPolicy::class,
            Amenity::class => AmenityPolicy::class,
            Booking::class => BookingPolicy::class,
            BookingAddon::class => BookingAddonPolicy::class,
            BookingRoom::class => BookingRoomPolicy::class,
            Favorite::class => FavoritePolicy::class,
            GuestPreference::class => GuestPreferencePolicy::class,
            Invoice::class => InvoicePolicy::class,
            InvoiceItem::class => InvoiceItemPolicy::class,
            Payment::class => PaymentPolicy::class,
            Review::class => ReviewPolicy::class,
            Room::class => RoomPolicy::class,
            RoomAvailability::class => RoomAvailabilityPolicy::class,
            RoomType::class => RoomTypePolicy::class,
            HousekeepingTask::class => HousekeepingTaskPolicy::class,
            MaintenanceLog::class => MaintenanceLogPolicy::class,
            ActivityLog::class => ActivityLogPolicy::class,
            HotelSetting::class => HotelSettingPolicy::class,
        ] as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }
}
