<?php

namespace Modules\Cms\Database\Factories\Offer;

use Modules\Cms\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OfferFactory extends Factory
{
    protected $model = Offer::class;

    public function definition(): array
    {
        $title = $this->faker->unique()->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph(),
            'terms_conditions' => $this->faker->sentence(),
            'discount_type' => $this->faker->randomElement(['percentage', 'fixed_amount', 'free_night']),
            'discount_value' => $this->faker->randomFloat(2, 5, 50),
            'min_nights' => $this->faker->numberBetween(1, 3),
            'max_nights' => $this->faker->numberBetween(4, 10),
            'valid_from' => now()->format('Y-m-d'),
            'valid_until' => now()->addMonths(3)->format('Y-m-d'),
            'applicable_room_types' => [],
            'is_active' => true,
            'image' => $this->faker->imageUrl(),
        ];
    }
}
