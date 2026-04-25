<?php

namespace Modules\Hotel\Database\Factories\Booking;

use Modules\Hotel\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $checkIn = now()->addDays($this->faker->numberBetween(-30, 30));
        $nights = $this->faker->numberBetween(1, 7);
        $checkOut = (clone $checkIn)->addDays($nights);
        $total = $this->faker->randomFloat(2, 100, 2000);
        $tax = $total * 0.14;
        
        return [
            'booking_reference' => 'BK-' . strtoupper(Str::random(8)),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'guest_name' => $this->faker->name(),
            'guest_email' => $this->faker->email(),
            'guest_phone' => $this->faker->phoneNumber(),
            'guest_nationality' => $this->faker->country(),
            'guest_id_type' => $this->faker->randomElement(['passport', 'national_id', 'driving_license']),
            'guest_id_number' => $this->faker->numerify('##########'),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled', 'no_show']),
            'source' => $this->faker->randomElement(['website', 'walk_in', 'phone', 'online', 'travel_agent', 'corporate']),
            'check_in_date' => $checkIn->format('Y-m-d'),
            'check_out_date' => $checkOut->format('Y-m-d'),
            'nights' => $nights,
            'adults' => $this->faker->numberBetween(1, 4),
            'children' => $this->faker->numberBetween(0, 2),
            'total_amount' => $total + $tax,
            'tax_amount' => $tax,
            'paid_amount' => 0,
            'balance_due' => $total + $tax,
            'currency' => 'USD',
            'payment_status' => 'pending',
        ];
    }
}
