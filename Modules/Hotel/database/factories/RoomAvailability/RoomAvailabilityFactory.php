<?php

namespace Modules\Hotel\Database\Factories\RoomAvailability;

use Modules\Hotel\Models\RoomAvailability;
use Modules\Hotel\Models\Room;
use Modules\Hotel\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomAvailabilityFactory extends Factory
{
    protected $model = RoomAvailability::class;

    public function definition(): array
    {
        return [
            'room_id' => Room::factory(),
            'date' => $this->faker->dateTimeBetween('-30 days', '+30 days')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['available', 'booked', 'blocked', 'maintenance']),
            'booking_id' => Booking::factory(),
            'price_for_date' => $this->faker->randomFloat(2, 50, 500),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
