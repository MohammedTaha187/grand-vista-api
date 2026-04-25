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
    $this->contactMessage = ContactMessage::factory()->create();
});

it('can list all contactMessages', function () {
    actingAs($this->admin)
        ->getJson('/api/v1/contact-messages')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a contactMessage', function () {
    $payload = ContactMessage::factory()->make()->toArray();

    actingAs($this->admin)
        ->postJson('/api/v1/contact-messages', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a contactMessage', function () {
    actingAs($this->admin)
        ->getJson("/api/v1/contact-messages/{$this->contactMessage->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->contactMessage->id);
});

it('can update a contactMessage', function () {
    $payload = ContactMessage::factory()->make()->toArray();

    actingAs($this->admin)
        ->putJson("/api/v1/contact-messages/{$this->contactMessage->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a contactMessage', function () {
    actingAs($this->admin)
        ->deleteJson("/api/v1/contact-messages/{$this->contactMessage->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('contact_messages', ['id' => $this->contactMessage->id]);
});
