<?php

namespace Modules\Cms\Database\Factories\Gallery;

use Modules\Cms\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    protected $model = Gallery::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'category' => $this->faker->randomElement(['rooms', 'pool', 'dining', 'spa', 'beach', 'events', 'exterior', 'interior', 'wellness', 'wedding']),
            'image_url' => $this->faker->imageUrl(),
            'thumbnail_url' => $this->faker->imageUrl(200, 200),
            'caption' => $this->faker->sentence(),
            'sort_order' => $this->faker->numberBetween(0, 100),
            'is_featured' => $this->faker->boolean(),
        ];
    }
}
