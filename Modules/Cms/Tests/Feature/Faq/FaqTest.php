<?php

use Modules\Cms\Models\Faq;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'faqs'; // Route is often the kebab version of model
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
    $this->faq = Faq::factory()->create();
});

it('can list all faqs', function () {
    actingAs($this->admin, 'api')
        ->getJson('/api/v1/cms/admin/faqs')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a faq', function () {
    $payload = Faq::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->postJson('/api/v1/cms/admin/faqs', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a faq', function () {
    actingAs($this->admin, 'api')
        ->getJson("/api/v1/cms/admin/faqs/{$this->faq->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->faq->id);
});

it('can update a faq', function () {
    $payload = Faq::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->putJson("/api/v1/cms/admin/faqs/{$this->faq->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a faq', function () {
    actingAs($this->admin, 'api')
        ->deleteJson("/api/v1/cms/admin/faqs/{$this->faq->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('faqs', ['id' => $this->faq->id]);
});
