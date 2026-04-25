<?php

use Modules\Cms\Models\Gallery;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'galleries'; // Route is often the kebab version of model
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
    $this->gallery = Gallery::factory()->create();
});

it('can list all galleries', function () {
    actingAs($this->admin, 'api')
        ->getJson('/api/v1/cms/admin/galleries')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a gallery', function () {
    $payload = Gallery::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->postJson('/api/v1/cms/admin/galleries', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a gallery', function () {
    actingAs($this->admin, 'api')
        ->getJson("/api/v1/cms/admin/galleries/{$this->gallery->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->gallery->id);
});

it('can update a gallery', function () {
    $payload = Gallery::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->putJson("/api/v1/cms/admin/galleries/{$this->gallery->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a gallery', function () {
    actingAs($this->admin, 'api')
        ->deleteJson("/api/v1/cms/admin/galleries/{$this->gallery->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('galleries', ['id' => $this->gallery->id]);
});
