<?php

namespace Modules\Hotel\Database\Factories\Amenity;

use Modules\Hotel\Models\Amenity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AmenityFactory extends Factory
{
    protected $model = Amenity::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->word();
        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'icon' => 'wifi',
            'description' => $this->faker->sentence(),
            'category' => $this->faker->randomElement(['room', 'bathroom', 'technology', 'comfort', 'dining', 'wellness', 'recreation', 'business']),
            'is_premium' => $this->faker->boolean(20),
            'is_active' => true,
        ];
    }
}
