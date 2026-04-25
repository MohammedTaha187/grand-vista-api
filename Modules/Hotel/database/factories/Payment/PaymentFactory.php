<?php

namespace Modules\Hotel\Database\Factories\Payment;

use Modules\Hotel\Models\Payment;
use Modules\Hotel\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'booking_id' => Booking::inRandomOrder()->first()?->id ?? Booking::factory(),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'amount' => $this->faker->randomFloat(2, 50, 1000),
            'currency' => 'USD',
            'payment_method' => $this->faker->randomElement(['cash', 'credit_card', 'bank_transfer', 'paypal', 'stripe']),
            'payment_gateway' => $this->faker->randomElement(['stripe', 'paypal', 'manual']),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed', 'refunded']),
            'paid_at' => now(),
        ];
    }
}
