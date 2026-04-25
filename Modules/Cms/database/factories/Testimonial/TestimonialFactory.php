<?php

namespace Modules\Cms\Database\Factories\Testimonial;

use Modules\Cms\Models\Testimonial;
use Modules\Hotel\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        return [
            'guest_name' => $this->faker->name(),
            'guest_country' => $this->faker->country(),
            'guest_avatar' => $this->faker->imageUrl(100, 100, 'people'),
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->paragraph(),
            'room_type_id' => RoomType::inRandomOrder()->first()?->id,
            'stay_dates' => $this->faker->monthName() . ' ' . $this->faker->year(),
            'is_featured' => $this->faker->boolean(),
            'is_approved' => true,
        ];
    }
}
