<?php

namespace Modules\Setting\Database\Factories\ActivityLog;

use Modules\Setting\Models\ActivityLog;
use Modules\Hotel\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityLogFactory extends Factory
{
    protected $model = ActivityLog::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'booking_id' => Booking::inRandomOrder()->first()?->id,
            'action' => $this->faker->randomElement(['created', 'updated', 'deleted', 'checked_in', 'checked_out', 'cancelled', 'paid', 'refunded', 'viewed']),
            'entity_type' => $this->faker->randomElement(['booking', 'user', 'room', 'payment', 'invoice']),
            'entity_id' => $this->faker->uuid,
            'description' => $this->faker->sentence(),
            'ip_address' => $this->faker->ipv4,
            'user_agent' => $this->faker->userAgent,
        ];
    }
}
