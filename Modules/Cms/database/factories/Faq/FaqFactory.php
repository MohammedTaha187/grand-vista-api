<?php

namespace Modules\Cms\Database\Factories\Faq;

use Modules\Cms\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    protected $model = Faq::class;

    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence() . '?',
            'answer' => $this->faker->paragraph(),
            'category' => $this->faker->randomElement(['booking', 'rooms', 'dining', 'spa', 'payment', 'general', 'policies']),
            'sort_order' => $this->faker->numberBetween(0, 100),
            'is_active' => true,
        ];
    }
}
