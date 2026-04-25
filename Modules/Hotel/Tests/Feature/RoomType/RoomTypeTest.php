<?php

use Modules\Hotel\Models\RoomType;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'room-types'; // Route is often the kebab version of model
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
    $this->roomType = RoomType::factory()->create();
});

it('can list all roomTypes', function () {
    actingAs($this->admin)
        ->getJson('/api/v1/room-types')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a roomType', function () {
    $payload = RoomType::factory()->make()->toArray();

    actingAs($this->admin)
        ->postJson('/api/v1/room-types', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a roomType', function () {
    actingAs($this->admin)
        ->getJson("/api/v1/room-types/{$this->roomType->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->roomType->id);
});

it('can update a roomType', function () {
    $payload = RoomType::factory()->make()->toArray();

    actingAs($this->admin)
        ->putJson("/api/v1/room-types/{$this->roomType->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a roomType', function () {
    actingAs($this->admin)
        ->deleteJson("/api/v1/room-types/{$this->roomType->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('room_types', ['id' => $this->roomType->id]);
});
