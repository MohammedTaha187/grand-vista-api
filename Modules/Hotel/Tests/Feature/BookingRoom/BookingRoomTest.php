<?php

use Modules\Hotel\Models\BookingRoom;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'booking-rooms'; // Route is often the kebab version of model
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
    $this->bookingRoom = BookingRoom::factory()->create();
});

it('can list all bookingRooms', function () {
    actingAs($this->admin)
        ->getJson('/api/v1/booking-rooms')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a bookingRoom', function () {
    $payload = BookingRoom::factory()->make()->toArray();

    actingAs($this->admin)
        ->postJson('/api/v1/booking-rooms', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a bookingRoom', function () {
    actingAs($this->admin)
        ->getJson("/api/v1/booking-rooms/{$this->bookingRoom->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->bookingRoom->id);
});

it('can update a bookingRoom', function () {
    $payload = BookingRoom::factory()->make()->toArray();

    actingAs($this->admin)
        ->putJson("/api/v1/booking-rooms/{$this->bookingRoom->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a bookingRoom', function () {
    actingAs($this->admin)
        ->deleteJson("/api/v1/booking-rooms/{$this->bookingRoom->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('booking_rooms', ['id' => $this->bookingRoom->id]);
});
