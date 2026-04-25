<?php

namespace Modules\Hotel\Database\Factories\Room;

use Modules\Hotel\Models\Room;
use Modules\Hotel\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition(): array
    {
        return [
            'room_type_id' => RoomType::inRandomOrder()->first()?->id ?? RoomType::factory(),
            'room_number' => $this->faker->unique()->numberBetween(100, 999),
            'floor' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['available', 'occupied', 'maintenance', 'reserved', 'cleaning', 'out_of_order']),
            'price_override' => null,
            'notes' => $this->faker->sentence(),
            'last_cleaned_at' => now(),
        ];
    }
}
