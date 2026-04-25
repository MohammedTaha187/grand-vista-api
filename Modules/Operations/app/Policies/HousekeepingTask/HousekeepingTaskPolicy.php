<?php

namespace Modules\Operations\Policies\HousekeepingTask;

use Modules\Operations\Models\HousekeepingTask;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HousekeepingTaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-housekeepingTask');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, HousekeepingTask $housekeepingTask): bool
    {
        return $user->hasPermissionTo('view-housekeepingTask');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-housekeepingTask');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, HousekeepingTask $housekeepingTask): bool
    {
        return $user->hasPermissionTo('update-housekeepingTask');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, HousekeepingTask $housekeepingTask): bool
    {
        return $user->hasPermissionTo('delete-housekeepingTask');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, HousekeepingTask $housekeepingTask): bool
    {
        return $user->hasPermissionTo('restore-housekeepingTask');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, HousekeepingTask $housekeepingTask): bool
    {
        return $user->hasPermissionTo('force-delete-housekeepingTask');
    }
}
