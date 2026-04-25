<?php

namespace Modules\Hotel\Database\Factories\BookingRoom;

use Modules\Hotel\Models\BookingRoom;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Hotel\Models\Booking;
use Modules\Hotel\Models\Room;
use Modules\Hotel\Models\RoomType;

class BookingRoomFactory extends Factory
{
    protected $model = BookingRoom::class;

    public function definition(): array
    {
        $room = Room::inRandomOrder()->first() ?? \Modules\Hotel\Database\Factories\Room\RoomFactory::new()->create();
        $price = $this->faker->randomFloat(2, 50, 500);
        $nights = $this->faker->numberBetween(1, 7);
        
        return [
            'booking_id' => Booking::inRandomOrder()->first()?->id ?? \Modules\Hotel\Database\Factories\Booking\BookingFactory::new(),
            'room_id' => $room->id,
            'room_type_id' => $room->room_type_id,
            'price_per_night' => $price,
            'nights' => $nights,
            'subtotal' => $price * $nights,
        ];
    }
}
