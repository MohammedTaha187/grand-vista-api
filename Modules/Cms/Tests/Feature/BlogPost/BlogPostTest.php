<?php

use Modules\Cms\Models\BlogPost;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'blog-posts'; // Route is often the kebab version of model
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
    $this->blogPost = BlogPost::factory()->create();
});

it('can list all blogPosts', function () {
    actingAs($this->admin)
        ->getJson('/api/v1/blog-posts')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a blogPost', function () {
    $payload = BlogPost::factory()->make()->toArray();

    actingAs($this->admin)
        ->postJson('/api/v1/blog-posts', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a blogPost', function () {
    actingAs($this->admin)
        ->getJson("/api/v1/blog-posts/{$this->blogPost->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->blogPost->id);
});

it('can update a blogPost', function () {
    $payload = BlogPost::factory()->make()->toArray();

    actingAs($this->admin)
        ->putJson("/api/v1/blog-posts/{$this->blogPost->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a blogPost', function () {
    actingAs($this->admin)
        ->deleteJson("/api/v1/blog-posts/{$this->blogPost->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('blog_posts', ['id' => $this->blogPost->id]);
});
