<?php

namespace Modules\Setting\Database\Factories\HotelSetting;

use Modules\Setting\Models\HotelSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelSettingFactory extends Factory
{
    protected $model = HotelSetting::class;

    public function definition(): array
    {
        return [
            'key' => $this->faker->unique()->word,
            'value' => $this->faker->word,
            'type' => $this->faker->randomElement(['string', 'integer', 'boolean', 'json', 'file']),
            'group' => $this->faker->randomElement(['general', 'contact', 'social', 'seo', 'payment', 'email', 'appearance']),
            'is_public' => $this->faker->boolean,
        ];
    }
}
