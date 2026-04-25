<?php

use Modules\Setting\Models\ActivityLog;
use App\Models\User;
use Laravel\Passport\Passport;
use function Pest\Laravel\{getJson, postJson, putJson, patchJson, deleteJson};

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $modelKebab = 'activity-logs'; // Route is often the kebab version of model
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

    $this->admin = User::factory()->create();
    $this->admin->assignRole($role);
    $this->activityLog = ActivityLog::factory()->create();
});

it('can list all activityLogs', function () {
    Passport::actingAs($this->admin)
        ->getJson('/api/v1/settings/admin/activity-logs')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data', 'message']);
});

it('can create a activityLog', function () {
    $payload = ActivityLog::factory()->make()->toArray();

    Passport::actingAs($this->admin)
        ->postJson('/api/v1/settings/admin/activity-logs', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => ['id']]);
});

it('can show a activityLog', function () {
    Passport::actingAs($this->admin)
        ->getJson("/api/v1/settings/admin/activity-logs/{$this->activityLog->id}")
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.id', $this->activityLog->id);
});

it('can update a activityLog', function () {
    $payload = ActivityLog::factory()->make()->toArray();

    Passport::actingAs($this->admin)
        ->putJson("/api/v1/settings/admin/activity-logs/{$this->activityLog->id}", $payload)
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('can delete a activityLog', function () {
    Passport::actingAs($this->admin)
        ->deleteJson("/api/v1/settings/admin/activity-logs/{$this->activityLog->id}")
        ->assertNoContent();

    $this->assertDatabaseMissing('activity_logs', ['id' => $this->activityLog->id]);
});
