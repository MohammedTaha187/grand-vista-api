<?php

use Modules\Hotel\Models\GuestPreference;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'guest-preferences'; // Route is often the kebab version of model
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
    $this->guestPreference = GuestPreference::factory()->create();
});

it('can list all guestPreferences', function () {
    actingAs($this->admin)
        ->getJson('/api/v1/guest-preferences')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a guestPreference', function () {
    $payload = GuestPreference::factory()->make()->toArray();

    actingAs($this->admin)
        ->postJson('/api/v1/guest-preferences', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a guestPreference', function () {
    actingAs($this->admin)
        ->getJson("/api/v1/guest-preferences/{$this->guestPreference->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->guestPreference->id);
});

it('can update a guestPreference', function () {
    $payload = GuestPreference::factory()->make()->toArray();

    actingAs($this->admin)
        ->putJson("/api/v1/guest-preferences/{$this->guestPreference->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a guestPreference', function () {
    actingAs($this->admin)
        ->deleteJson("/api/v1/guest-preferences/{$this->guestPreference->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('guest_preferences', ['id' => $this->guestPreference->id]);
});
