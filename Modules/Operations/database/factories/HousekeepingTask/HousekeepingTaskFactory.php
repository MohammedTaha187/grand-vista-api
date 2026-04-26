<?php

namespace Modules\Operations\Database\Factories\HousekeepingTask;

use Modules\Operations\Models\HousekeepingTask;
use Modules\Hotel\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HousekeepingTaskFactory extends Factory
{
    protected $model = HousekeepingTask::class;

    public function definition(): array
    {
        return [
            'room_id' => Room::inRandomOrder()->first()?->id ?? Room::factory(),
            'assigned_to' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'task_type' => $this->faker->randomElement(['cleaning', 'maintenance', 'inspection', 'turndown', 'deep_clean', 'linen_change']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high', 'urgent']),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed', 'cancelled']),
            'scheduled_at' => now()->addHours($this->faker->numberBetween(1, 48))->format('Y-m-d H:i:s'),
            'notes' => $this->faker->sentence(),
        ];
    }
}
