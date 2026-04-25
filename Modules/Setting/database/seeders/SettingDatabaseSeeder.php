<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Setting\Models\HotelSetting;
use Modules\Setting\Models\ActivityLog;
use Modules\Setting\Database\Factories\ActivityLog\ActivityLogFactory;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'hotel_name', 'value' => 'Grand Vista Hotel', 'type' => 'string', 'group' => 'general', 'is_public' => true],
            ['key' => 'hotel_address', 'value' => '123 Luxury Ave, Resort City', 'type' => 'string', 'group' => 'general', 'is_public' => true],
            ['key' => 'hotel_email', 'value' => 'info@grandvista.com', 'type' => 'string', 'group' => 'contact', 'is_public' => true],
            ['key' => 'hotel_phone', 'value' => '+1 234 567 890', 'type' => 'string', 'group' => 'contact', 'is_public' => true],
            ['key' => 'currency', 'value' => 'USD', 'type' => 'string', 'group' => 'general', 'is_public' => true],
            ['key' => 'vat_percentage', 'value' => '15', 'type' => 'integer', 'group' => 'payment', 'is_public' => false],
            ['key' => 'check_in_time', 'value' => '14:00', 'type' => 'string', 'group' => 'general', 'is_public' => true],
            ['key' => 'check_out_time', 'value' => '12:00', 'type' => 'string', 'group' => 'general', 'is_public' => true],
        ];

        foreach ($settings as $setting) {
            HotelSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        ActivityLogFactory::new()->count(30)->create();
    }
}
