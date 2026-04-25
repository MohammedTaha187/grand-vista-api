<?php

namespace Modules\Hotel\Database\Factories\GuestPreference;

use Modules\Hotel\Models\GuestPreference;
use App\Models\User;
use Modules\Hotel\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestPreferenceFactory extends Factory
{
    protected $model = GuestPreference::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'preferred_room_type_id' => RoomType::factory(),
            'preferred_floor' => $this->faker->numberBetween(1, 10),
            'preferred_bed_type' => $this->faker->randomElement(['single', 'double', 'king', 'queen', 'twin']),
            'dietary_requirements' => $this->faker->optional()->sentence(),
            'allergies' => $this->faker->randomElements(['nuts', 'dairy', 'gluten', 'seafood', 'pollen'], $this->faker->numberBetween(0, 2)),
            'special_needs' => $this->faker->optional()->sentence(),
            'preferred_language' => 'en',
            'staff_notes' => $this->faker->optional()->sentence(),
        ];
    }
}
