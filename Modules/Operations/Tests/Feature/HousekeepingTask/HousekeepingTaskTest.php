<?php

use Modules\Operations\Models\HousekeepingTask;
use App\Models\User;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson, actingAs};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'housekeeping-tasks'; // Route is often the kebab version of model
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
    $this->housekeepingTask = HousekeepingTask::factory()->create();
});

it('can list all housekeepingTasks', function () {
    actingAs($this->admin)
        ->getJson('/api/v1/housekeeping-tasks')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a housekeepingTask', function () {
    $payload = HousekeepingTask::factory()->make()->toArray();

    actingAs($this->admin)
        ->postJson('/api/v1/housekeeping-tasks', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a housekeepingTask', function () {
    actingAs($this->admin)
        ->getJson("/api/v1/housekeeping-tasks/{$this->housekeepingTask->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->housekeepingTask->id);
});

it('can update a housekeepingTask', function () {
    $payload = HousekeepingTask::factory()->make()->toArray();

    actingAs($this->admin)
        ->putJson("/api/v1/housekeeping-tasks/{$this->housekeepingTask->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a housekeepingTask', function () {
    actingAs($this->admin)
        ->deleteJson("/api/v1/housekeeping-tasks/{$this->housekeepingTask->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('housekeeping_tasks', ['id' => $this->housekeepingTask->id]);
});
