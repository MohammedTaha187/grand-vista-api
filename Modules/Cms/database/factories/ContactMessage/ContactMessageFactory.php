<?php

namespace Modules\Cms\Database\Factories\ContactMessage;

use Modules\Cms\Models\ContactMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactMessageFactory extends Factory
{
    protected $model = ContactMessage::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'subject' => $this->faker->sentence(),
            'message' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['new', 'read', 'replied', 'archived']),
        ];
    }
}
