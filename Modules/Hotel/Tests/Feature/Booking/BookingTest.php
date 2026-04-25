<?php

use Modules\Hotel\Models\Booking;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'bookings'; // Route is often the kebab version of model
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
    $this->booking = Booking::factory()->create();
});

it('can list all bookings', function () {
    actingAs($this->admin)
        ->getJson('/api/v1/bookings')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a booking', function () {
    $payload = Booking::factory()->make()->toArray();

    actingAs($this->admin)
        ->postJson('/api/v1/bookings', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a booking', function () {
    actingAs($this->admin)
        ->getJson("/api/v1/bookings/{$this->booking->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->booking->id);
});

it('can update a booking', function () {
    $payload = Booking::factory()->make()->toArray();

    actingAs($this->admin)
        ->putJson("/api/v1/bookings/{$this->booking->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a booking', function () {
    actingAs($this->admin)
        ->deleteJson("/api/v1/bookings/{$this->booking->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('bookings', ['id' => $this->booking->id]);
});
