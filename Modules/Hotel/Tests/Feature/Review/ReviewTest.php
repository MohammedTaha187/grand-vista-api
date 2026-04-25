<?php

use Modules\Hotel\Models\Review;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'reviews'; // Route is often the kebab version of model
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
    $this->review = Review::factory()->create();
});

it('can list all reviews', function () {
    actingAs($this->admin, 'api')
        ->getJson('/api/v1/hotel/admin/reviews')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a review', function () {
    $payload = Review::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->postJson('/api/v1/hotel/admin/reviews', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a review', function () {
    actingAs($this->admin, 'api')
        ->getJson("/api/v1/hotel/admin/reviews/{$this->review->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->review->id);
});

it('can update a review', function () {
    $payload = Review::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->putJson("/api/v1/hotel/admin/reviews/{$this->review->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a review', function () {
    actingAs($this->admin, 'api')
        ->deleteJson("/api/v1/hotel/admin/reviews/{$this->review->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('reviews', ['id' => $this->review->id]);
});
