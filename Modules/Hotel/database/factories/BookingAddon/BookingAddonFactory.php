<?php

namespace Modules\Hotel\Database\Factories\BookingAddon;

use Modules\Hotel\Models\BookingAddon;
use Modules\Hotel\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingAddonFactory extends Factory
{
    protected $model = BookingAddon::class;

    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'addon_type' => $this->faker->randomElement([
                'early_checkin',
                'late_checkout',
                'extra_bed',
                'breakfast',
                'airport_transfer_arrival',
                'airport_transfer_departure',
                'minibar',
                'room_service',
            ]),
            'addon_name' => $this->faker->words(3, true),
            'quantity' => $this->faker->numberBetween(1, 3),
            'unit_price' => $this->faker->randomFloat(2, 10, 200),
            'total_price' => $this->faker->randomFloat(2, 10, 600),
        ];
    }
}
