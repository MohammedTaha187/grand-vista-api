<?php

use Modules\Operations\Models\MaintenanceLog;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'maintenance-logs'; // Route is often the kebab version of model
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
    $this->maintenanceLog = MaintenanceLog::factory()->create();
});

it('can list all maintenanceLogs', function () {
    actingAs($this->admin, 'api')
        ->getJson('/api/v1/operations/admin/maintenance')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a maintenanceLog', function () {
    $payload = MaintenanceLog::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->postJson('/api/v1/operations/admin/maintenance', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a maintenanceLog', function () {
    actingAs($this->admin, 'api')
        ->getJson("/api/v1/operations/admin/maintenance/{$this->maintenanceLog->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->maintenanceLog->id);
});

it('can update a maintenanceLog', function () {
    $payload = MaintenanceLog::factory()->make()->toArray();

    actingAs($this->admin, 'api')
        ->putJson("/api/v1/operations/admin/maintenance/{$this->maintenanceLog->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a maintenanceLog', function () {
    actingAs($this->admin, 'api')
        ->deleteJson("/api/v1/operations/admin/maintenance/{$this->maintenanceLog->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('maintenance_logs', ['id' => $this->maintenanceLog->id]);
});
