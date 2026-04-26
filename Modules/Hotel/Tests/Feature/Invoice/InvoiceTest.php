<?php

use Modules\Hotel\Models\Invoice;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'invoices'; // Route is often the kebab version of model
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
    $this->invoice = Invoice::factory()->create();
});

it('can list all invoices', function () {
    actingAs($this->admin, 'api')
        ->getJson('/api/v1/hotel/admin/invoices')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a invoice', function () {
    $payload = Invoice::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->postJson('/api/v1/hotel/admin/invoices', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a invoice', function () {
    actingAs($this->admin, 'api')
        ->getJson("/api/v1/hotel/admin/invoices/{$this->invoice->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->invoice->id);
});

it('can update a invoice', function () {
    $payload = Invoice::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->putJson("/api/v1/hotel/admin/invoices/{$this->invoice->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a invoice', function () {
    actingAs($this->admin, 'api')
        ->deleteJson("/api/v1/hotel/admin/invoices/{$this->invoice->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('invoices', ['id' => $this->invoice->id]);
});
