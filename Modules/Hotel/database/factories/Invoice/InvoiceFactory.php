<?php

namespace Modules\Hotel\Database\Factories\Invoice;

use Modules\Hotel\Models\Invoice;
use Modules\Hotel\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        return [
            'invoice_number' => 'INV-' . strtoupper(Str::random(10)),
            'booking_id' => Booking::factory(),
            'user_id' => User::factory(),
            'issue_date' => now()->format('Y-m-d'),
            'due_date' => now()->addDays(14)->format('Y-m-d'),
            'subtotal' => $this->faker->randomFloat(2, 100, 2000),
            'tax_rate' => 14.00,
            'tax_amount' => $this->faker->randomFloat(2, 10, 280),
            'discount_amount' => 0.00,
            'total_amount' => $this->faker->randomFloat(2, 110, 2280),
            'paid_amount' => 0.00,
            'balance_due' => $this->faker->randomFloat(2, 110, 2280),
            'status' => 'draft',
            'payment_method' => null,
            'paid_at' => null,
            'pdf_url' => null,
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
