<?php

namespace Modules\Hotel\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Hotel\Models\RoomType;
use Modules\Hotel\Models\Amenity;
use Modules\Hotel\Models\Room;
use Modules\Hotel\Models\Booking;
use Modules\Hotel\Models\Payment;
use Modules\Hotel\Models\Review;
use Modules\Hotel\Models\BookingRoom;
use App\Models\User;
use Modules\Hotel\Database\Factories\RoomType\RoomTypeFactory;
use Modules\Hotel\Database\Factories\Amenity\AmenityFactory;
use Modules\Hotel\Database\Factories\Room\RoomFactory;
use Modules\Hotel\Database\Factories\Booking\BookingFactory;
use Modules\Hotel\Database\Factories\Payment\PaymentFactory;
use Modules\Hotel\Database\Factories\Review\ReviewFactory;
use Modules\Hotel\Database\Factories\BookingRoom\BookingRoomFactory;

class HotelDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Room Types
        $roomTypes = RoomTypeFactory::new()->count(5)->create();

        // 2. Create Amenities
        $amenities = AmenityFactory::new()->count(15)->create();

        // 3. Attach Amenities to Room Types
        $roomTypes->each(function ($roomType) use ($amenities) {
            $roomType->amenities()->attach(
                $amenities->random(rand(5, 10))->pluck('id')->toArray()
            );

            // 4. Create Rooms for each type
            RoomFactory::new()->count(5)->create([
                'room_type_id' => $roomType->id
            ]);
        });

        // 5. Create Bookings
        $bookings = BookingFactory::new()->count(20)->create();

        // 6. Create Booking Rooms
        $bookings->each(function ($booking) {
            BookingRoomFactory::new()->count(rand(1, 2))->create([
                'booking_id' => $booking->id
            ]);

            // 7. Create Payments for some bookings
            if (rand(0, 1)) {
                PaymentFactory::new()->count(rand(1, 2))->create([
                    'booking_id' => $booking->id,
                    'user_id' => $booking->user_id
                ]);
            }

            // 8. Create Reviews for checked_out bookings
            if ($booking->status === 'checked_out') {
                ReviewFactory::new()->create([
                    'booking_id' => $booking->id,
                    'user_id' => $booking->user_id
                ]);
            }
        });
    }
}
