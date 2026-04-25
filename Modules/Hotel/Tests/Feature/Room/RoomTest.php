<?php

use Modules\Hotel\Models\Room;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'rooms'; // Route is often the kebab version of model
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
});

it('can list all rooms', function () {
    actingAs($this->admin, 'api')
        ->getJson('/api/v1/hotel/admin/rooms')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a room', function () {
    $payload = Room::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->postJson('/api/v1/hotel/admin/rooms', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a room', function () {
    actingAs($this->admin, 'api')
        ->getJson("/api/v1/hotel/admin/rooms/{$this->room->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->room->id);
});

it('can update a room', function () {
    $payload = Room::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->putJson("/api/v1/hotel/admin/rooms/{$this->room->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a room', function () {
    actingAs($this->admin, 'api')
        ->deleteJson("/api/v1/hotel/admin/rooms/{$this->room->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('rooms', ['id' => $this->room->id]);
});
