<?php

use Modules\Hotel\Models\BookingAddon;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'booking-addons'; // Route is often the kebab version of model
    // Strip trailing 's' if any (Route is plural)
    $singleKey = \Illuminate\Support\Str::singular($modelKebab);

    $role = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
    
    $permissions = [
        "view-any-{$singleKey}",
        "view-{$singleKey}",
        "create-{$singleKey}",
        "update-{$singleKey}",
        "delete-{$singleKey}",
    ];

    foreach ($permissions as $p) {
        Permission::firstOrCreate(['name' => $p, 'guard_name' => 'web']);
        $role->givePermissionTo($p);
    }

    $this->admin = User::factory()->create()->assignRole('admin');
    $this->bookingAddon = BookingAddon::factory()->create();
});

it('can list all bookingAddons', function () {
    actingAs($this->admin)
        ->getJson('/api/v1/booking-addons')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a bookingAddon', function () {
    $payload = BookingAddon::factory()->make()->toArray();

    actingAs($this->admin)
        ->postJson('/api/v1/booking-addons', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a bookingAddon', function () {
    actingAs($this->admin)
        ->getJson("/api/v1/booking-addons/{$this->bookingAddon->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->bookingAddon->id);
});

it('can update a bookingAddon', function () {
    $payload = BookingAddon::factory()->make()->toArray();

    actingAs($this->admin)
        ->putJson("/api/v1/booking-addons/{$this->bookingAddon->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a bookingAddon', function () {
    actingAs($this->admin)
        ->deleteJson("/api/v1/booking-addons/{$this->bookingAddon->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('booking_addons', ['id' => $this->bookingAddon->id]);
});
