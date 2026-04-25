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
    $this->review = Review::factory()->create();
});

it('can list all reviews', function () {
    actingAs($this->admin)
        ->getJson('/api/v1/reviews')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a review', function () {
    $payload = Review::factory()->make()->toArray();

    actingAs($this->admin)
        ->postJson('/api/v1/reviews', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a review', function () {
    actingAs($this->admin)
        ->getJson("/api/v1/reviews/{$this->review->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->review->id);
});

it('can update a review', function () {
    $payload = Review::factory()->make()->toArray();

    actingAs($this->admin)
        ->putJson("/api/v1/reviews/{$this->review->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a review', function () {
    actingAs($this->admin)
        ->deleteJson("/api/v1/reviews/{$this->review->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('reviews', ['id' => $this->review->id]);
});
