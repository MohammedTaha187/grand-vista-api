<?php

use Modules\Cms\Models\ContactMessage;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'contact-messages'; // Route is often the kebab version of model
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
    $this->contactMessage = ContactMessage::factory()->create();
});

it('can list all contactMessages', function () {
    actingAs($this->admin, 'api')
        ->getJson('/api/v1/cms/admin/contact-messages')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a contactMessage', function () {
    $payload = ContactMessage::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->postJson('/api/v1/cms/admin/contact-messages', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a contactMessage', function () {
    actingAs($this->admin, 'api')
        ->getJson("/api/v1/cms/admin/contact-messages/{$this->contactMessage->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->contactMessage->id);
});

it('can update a contactMessage', function () {
    $payload = ContactMessage::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->putJson("/api/v1/cms/admin/contact-messages/{$this->contactMessage->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a contactMessage', function () {
    actingAs($this->admin, 'api')
        ->deleteJson("/api/v1/cms/admin/contact-messages/{$this->contactMessage->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('contact_messages', ['id' => $this->contactMessage->id]);
});
