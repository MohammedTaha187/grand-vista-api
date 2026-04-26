<?php

use Modules\Hotel\Models\RoomAvailability;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'room-availabilities'; // Route is often the kebab version of model
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
    $this->roomAvailability = RoomAvailability::factory()->create();
});

it('can list all roomAvailabilities', function () {
    actingAs($this->admin, 'api')
        ->getJson('/api/v1/hotel/admin/room-availabilities')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a roomAvailability', function () {
    $payload = RoomAvailability::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->postJson('/api/v1/hotel/admin/room-availabilities', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a roomAvailability', function () {
    actingAs($this->admin, 'api')
        ->getJson("/api/v1/hotel/admin/room-availabilities/{$this->roomAvailability->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->roomAvailability->id);
});

it('can update a roomAvailability', function () {
    $payload = RoomAvailability::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->putJson("/api/v1/hotel/admin/room-availabilities/{$this->roomAvailability->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a roomAvailability', function () {
    actingAs($this->admin, 'api')
        ->deleteJson("/api/v1/hotel/admin/room-availabilities/{$this->roomAvailability->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('room_availability', ['id' => $this->roomAvailability->id]);
});
