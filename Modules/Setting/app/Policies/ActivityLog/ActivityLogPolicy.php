<?php

namespace Modules\Setting\Policies\ActivityLog;

use Modules\Setting\Models\ActivityLog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityLogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-activityLog');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ActivityLog $activityLog): bool
    {
        return $user->hasPermissionTo('view-activityLog');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-activityLog');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ActivityLog $activityLog): bool
    {
        return $user->hasPermissionTo('update-activityLog');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ActivityLog $activityLog): bool
    {
        return $user->hasPermissionTo('delete-activityLog');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ActivityLog $activityLog): bool
    {
        return $user->hasPermissionTo('restore-activityLog');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ActivityLog $activityLog): bool
    {
        return $user->hasPermissionTo('force-delete-activityLog');
    }
}
