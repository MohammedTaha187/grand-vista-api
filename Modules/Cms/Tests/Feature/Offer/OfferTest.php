<?php

use Modules\Cms\Models\Offer;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'offers'; // Route is often the kebab version of model
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
    $this->offer = Offer::factory()->create();
});

it('can list all offers', function () {
    actingAs($this->admin, 'api')
        ->getJson('/api/v1/cms/admin/offers')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a offer', function () {
    $payload = Offer::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->postJson('/api/v1/cms/admin/offers', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a offer', function () {
    actingAs($this->admin, 'api')
        ->getJson("/api/v1/cms/admin/offers/{$this->offer->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->offer->id);
});

it('can update a offer', function () {
    $payload = Offer::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->putJson("/api/v1/cms/admin/offers/{$this->offer->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a offer', function () {
    actingAs($this->admin, 'api')
        ->deleteJson("/api/v1/cms/admin/offers/{$this->offer->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('offers', ['id' => $this->offer->id]);
});
