<?php

namespace Modules\Hotel\Database\Factories\Review;

use Modules\Hotel\Models\Review;
use Modules\Hotel\Models\Booking;
use Modules\Hotel\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'booking_id' => Booking::inRandomOrder()->first()?->id ?? Booking::factory(),
            'room_id' => Room::inRandomOrder()->first()?->id ?? Room::factory(),
            'rating' => $this->faker->numberBetween(1, 5),
            'cleanliness_rating' => $this->faker->numberBetween(1, 5),
            'service_rating' => $this->faker->numberBetween(1, 5),
            'comfort_rating' => $this->faker->numberBetween(1, 5),
            'location_rating' => $this->faker->numberBetween(1, 5),
            'value_rating' => $this->faker->numberBetween(1, 5),
            'title' => $this->faker->sentence(),
            'comment' => $this->faker->paragraph(),
            'is_approved' => true,
            'is_featured' => $this->faker->boolean(10),
        ];
    }
}
