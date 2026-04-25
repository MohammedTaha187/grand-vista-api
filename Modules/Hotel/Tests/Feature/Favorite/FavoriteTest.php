<?php

use Modules\Hotel\Models\Favorite;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'favorites'; // Route is often the kebab version of model
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
    $this->favorite = Favorite::factory()->create();
});

it('can list all favorites', function () {
    actingAs($this->admin)
        ->getJson('/api/v1/favorites')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a favorite', function () {
    $payload = Favorite::factory()->make()->toArray();

    actingAs($this->admin)
        ->postJson('/api/v1/favorites', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a favorite', function () {
    actingAs($this->admin)
        ->getJson("/api/v1/favorites/{$this->favorite->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->favorite->id);
});

it('can update a favorite', function () {
    $payload = Favorite::factory()->make()->toArray();

    actingAs($this->admin)
        ->putJson("/api/v1/favorites/{$this->favorite->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a favorite', function () {
    actingAs($this->admin)
        ->deleteJson("/api/v1/favorites/{$this->favorite->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('favorites', ['id' => $this->favorite->id]);
});
