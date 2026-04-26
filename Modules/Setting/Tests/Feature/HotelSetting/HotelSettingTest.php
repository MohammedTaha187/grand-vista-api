<?php

use Modules\Setting\Models\HotelSetting;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'hotel-settings'; // Route is often the kebab version of model
    // Strip trailing 's' if any (Route is plural)
    $singleKey = \Illuminate\Support\Str::singular($modelKebab);

    $role = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
    
    $permissions = [
        "view-any-{$singleKey}",
        "view-{$singleKey}",
        "create-{$singleKey}",
        "update-{$singleKey}",
        "delete-{$singleKey}",
    ];

    foreach ($permissions as $p) {
        Permission::firstOrCreate(['name' => $p, 'guard_name' => 'api']);
        $role->givePermissionTo($p);
    }

    $this->admin = User::factory()->create();
    $this->admin->assignRole($role);
    $this->hotelSetting = HotelSetting::factory()->create();
    $this->withoutMiddleware([
        \Illuminate\Auth\Middleware\Authenticate::class,
        \Spatie\Permission\Middleware\RoleMiddleware::class,
    ]);
});

it('can list all hotelSettings', function () {
    actingAs($this->admin, 'api')
        ->getJson('/api/v1/settings/admin/hotel-settings')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a hotelSetting', function () {
    $payload = HotelSetting::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->postJson('/api/v1/settings/admin/hotel-settings', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a hotelSetting', function () {
    actingAs($this->admin, 'api')
        ->getJson("/api/v1/settings/admin/hotel-settings/{$this->hotelSetting->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->hotelSetting->id);
});

it('can update a hotelSetting', function () {
    $payload = HotelSetting::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->putJson("/api/v1/settings/admin/hotel-settings/{$this->hotelSetting->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a hotelSetting', function () {
    actingAs($this->admin, 'api')
        ->deleteJson("/api/v1/settings/admin/hotel-settings/{$this->hotelSetting->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('hotel_settings', ['id' => $this->hotelSetting->id]);
});
