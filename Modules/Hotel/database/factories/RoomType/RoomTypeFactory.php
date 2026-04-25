<?php

namespace Modules\Hotel\Database\Factories\RoomType;

use Modules\Hotel\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoomTypeFactory extends Factory
{
    protected $model = RoomType::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement(['Standard Room', 'Deluxe Room', 'Junior Suite', 'Executive Suite', 'Presidential Suite', 'Family Room', 'Ocean View Suite']);
        return [
            'name' => $name,
            'description' => $this->faker->paragraph(),
            'slug' => Str::slug($name),
            'base_price' => $this->faker->randomFloat(2, 50, 1000),
            'capacity_adults' => $this->faker->numberBetween(1, 4),
            'capacity_children' => $this->faker->numberBetween(0, 2),
            'size_sqm' => $this->faker->numberBetween(20, 150),
            'bed_type' => $this->faker->randomElement(['single', 'double', 'king', 'queen', 'twin']),
            'view_type' => $this->faker->randomElement(['city', 'garden', 'mountain', 'pool', 'ocean']),
            'images' => [],
            'amenities' => [],
            'is_active' => true,
            'sort_order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
