<?php

namespace Modules\Operations\Policies\MaintenanceLog;

use Modules\Operations\Models\MaintenanceLog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaintenanceLogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-maintenanceLog');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MaintenanceLog $maintenanceLog): bool
    {
        return $user->hasPermissionTo('view-maintenanceLog');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-maintenanceLog');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MaintenanceLog $maintenanceLog): bool
    {
        return $user->hasPermissionTo('update-maintenanceLog');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MaintenanceLog $maintenanceLog): bool
    {
        return $user->hasPermissionTo('delete-maintenanceLog');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MaintenanceLog $maintenanceLog): bool
    {
        return $user->hasPermissionTo('restore-maintenanceLog');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MaintenanceLog $maintenanceLog): bool
    {
        return $user->hasPermissionTo('force-delete-maintenanceLog');
    }
}
