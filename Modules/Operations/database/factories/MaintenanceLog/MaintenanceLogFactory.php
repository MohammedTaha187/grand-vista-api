<?php

namespace Modules\Operations\Database\Factories\MaintenanceLog;

use Modules\Operations\Models\MaintenanceLog;
use Modules\Hotel\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaintenanceLogFactory extends Factory
{
    protected $model = MaintenanceLog::class;

    public function definition(): array
    {
        return [
            'room_id' => Room::inRandomOrder()->first()?->id ?? Room::factory(),
            'reported_by' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'issue_type' => $this->faker->randomElement(['plumbing', 'electrical', 'hvac', 'furniture', 'appliance', 'structural', 'other']),
            'description' => $this->faker->paragraph(),
            'severity' => $this->faker->randomElement(['minor', 'moderate', 'major', 'critical']),
            'status' => $this->faker->randomElement(['reported', 'in_progress', 'resolved', 'cancelled']),
            'cost' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
