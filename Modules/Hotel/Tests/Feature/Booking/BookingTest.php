<?php

use Modules\Hotel\Models\Booking;
use Modules\Hotel\Models\Room;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'bookings'; // Route is often the kebab version of model
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

    $this->admin = User::factory()->create()->assignRole($role);
    $this->room = Room::factory()->create();
    $this->booking = Booking::factory()->create();
});

it('can list all bookings', function () {
    actingAs($this->admin, 'api')
        ->getJson('/api/v1/hotel/admin/bookings')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a booking', function () {
    $payload = Booking::factory()->make()->toArray();
    $payload['room_id'] = $this->room->id;

    actingAs($this->admin, 'api')
        ->postJson('/api/v1/hotel/admin/bookings', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a booking', function () {
    actingAs($this->admin, 'api')
        ->getJson("/api/v1/hotel/admin/bookings/{$this->booking->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->booking->id);
});

it('can update a booking', function () {
    $payload = Booking::factory()->make()->toArray();
    $payload['room_id'] = $this->room->id;

    actingAs($this->admin, 'api')
        ->putJson("/api/v1/hotel/admin/bookings/{$this->booking->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a booking', function () {
    actingAs($this->admin, 'api')
        ->deleteJson("/api/v1/hotel/admin/bookings/{$this->booking->id}")
        ->assertNoContent();

    $this->assertSoftDeleted('bookings', ['id' => $this->booking->id]);
});
