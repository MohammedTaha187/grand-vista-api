<?php

use Modules\Cms\Models\Testimonial;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'testimonials'; // Route is often the kebab version of model
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
    $this->testimonial = Testimonial::factory()->create();
});

it('can list all testimonials', function () {
    actingAs($this->admin)
        ->getJson('/api/v1/testimonials')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a testimonial', function () {
    $payload = Testimonial::factory()->make()->toArray();

    actingAs($this->admin)
        ->postJson('/api/v1/testimonials', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a testimonial', function () {
    actingAs($this->admin)
        ->getJson("/api/v1/testimonials/{$this->testimonial->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->testimonial->id);
});

it('can update a testimonial', function () {
    $payload = Testimonial::factory()->make()->toArray();

    actingAs($this->admin)
        ->putJson("/api/v1/testimonials/{$this->testimonial->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a testimonial', function () {
    actingAs($this->admin)
        ->deleteJson("/api/v1/testimonials/{$this->testimonial->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('testimonials', ['id' => $this->testimonial->id]);
});
