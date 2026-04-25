<?php

namespace Modules\Operations\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Operations\Models\HousekeepingTask;
use Modules\Operations\Models\MaintenanceLog;
use Modules\Hotel\Models\Room;
use App\Models\User;
use Modules\Operations\Database\Factories\HousekeepingTask\HousekeepingTaskFactory;
use Modules\Operations\Database\Factories\MaintenanceLog\MaintenanceLogFactory;

class OperationsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = Room::all();
        $staff = User::all();

        if ($rooms->count() > 0 && $staff->count() > 0) {
            HousekeepingTaskFactory::new()->count(20)->create([
                'room_id' => fn() => $rooms->random()->id,
                'assigned_to' => fn() => $staff->random()->id,
            ]);

            MaintenanceLogFactory::new()->count(10)->create([
                'room_id' => fn() => $rooms->random()->id,
                'reported_by' => fn() => $staff->random()->id,
            ]);
        }
    }
}
