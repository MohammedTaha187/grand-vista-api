<?php

use Modules\Hotel\Models\Payment;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'payments'; // Route is often the kebab version of model
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
    $this->payment = Payment::factory()->create();
});

it('can list all payments', function () {
    actingAs($this->admin)
        ->getJson('/api/v1/payments')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a payment', function () {
    $payload = Payment::factory()->make()->toArray();

    actingAs($this->admin)
        ->postJson('/api/v1/payments', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a payment', function () {
    actingAs($this->admin)
        ->getJson("/api/v1/payments/{$this->payment->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->payment->id);
});

it('can update a payment', function () {
    $payload = Payment::factory()->make()->toArray();

    actingAs($this->admin)
        ->putJson("/api/v1/payments/{$this->payment->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a payment', function () {
    actingAs($this->admin)
        ->deleteJson("/api/v1/payments/{$this->payment->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('payments', ['id' => $this->payment->id]);
});
