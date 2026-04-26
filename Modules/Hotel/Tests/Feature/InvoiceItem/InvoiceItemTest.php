<?php

use Modules\Hotel\Models\InvoiceItem;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'invoice-items'; // Route is often the kebab version of model
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
    $this->invoiceItem = InvoiceItem::factory()->create();
});

it('can list all invoiceItems', function () {
    actingAs($this->admin, 'api')
        ->getJson('/api/v1/hotel/admin/invoice-items')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a invoiceItem', function () {
    $payload = InvoiceItem::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->postJson('/api/v1/hotel/admin/invoice-items', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a invoiceItem', function () {
    actingAs($this->admin, 'api')
        ->getJson("/api/v1/hotel/admin/invoice-items/{$this->invoiceItem->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->invoiceItem->id);
});

it('can update a invoiceItem', function () {
    $payload = InvoiceItem::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->putJson("/api/v1/hotel/admin/invoice-items/{$this->invoiceItem->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a invoiceItem', function () {
    actingAs($this->admin, 'api')
        ->deleteJson("/api/v1/hotel/admin/invoice-items/{$this->invoiceItem->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('invoice_items', ['id' => $this->invoiceItem->id]);
});
