<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Cms\Database\Seeders\CmsDatabaseSeeder;
use Modules\Hotel\Database\Seeders\HotelDatabaseSeeder;
use Modules\Operations\Database\Seeders\OperationsDatabaseSeeder;
use Modules\Setting\Database\Seeders\SettingDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'email' => 'test@example.com',
            'name' => 'Test User'
        ]);

        $this->call([
            HotelDatabaseSeeder::class,
            CmsDatabaseSeeder::class,
            OperationsDatabaseSeeder::class,
            SettingDatabaseSeeder::class,
        ]);
    }
}
