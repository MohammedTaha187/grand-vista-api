<?php

use Modules\Hotel\Models\Amenity;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'amenities'; // Route is often the kebab version of model
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
    $this->amenity = Amenity::factory()->create();
});

it('can list all amenities', function () {
    actingAs($this->admin)
        ->getJson('/api/v1/amenities')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a amenity', function () {
    $payload = Amenity::factory()->make()->toArray();

    actingAs($this->admin)
        ->postJson('/api/v1/amenities', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a amenity', function () {
    actingAs($this->admin)
        ->getJson("/api/v1/amenities/{$this->amenity->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->amenity->id);
});

it('can update a amenity', function () {
    $payload = Amenity::factory()->make()->toArray();

    actingAs($this->admin)
        ->putJson("/api/v1/amenities/{$this->amenity->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a amenity', function () {
    actingAs($this->admin)
        ->deleteJson("/api/v1/amenities/{$this->amenity->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('amenities', ['id' => $this->amenity->id]);
});
