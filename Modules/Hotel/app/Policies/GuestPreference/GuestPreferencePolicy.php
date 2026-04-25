<?php

namespace Modules\Hotel\Policies\GuestPreference;

use Modules\Hotel\Models\GuestPreference;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuestPreferencePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-guestPreference');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GuestPreference $guestPreference): bool
    {
        return $user->hasPermissionTo('view-guestPreference');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-guestPreference');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GuestPreference $guestPreference): bool
    {
        return $user->hasPermissionTo('update-guestPreference');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GuestPreference $guestPreference): bool
    {
        return $user->hasPermissionTo('delete-guestPreference');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GuestPreference $guestPreference): bool
    {
        return $user->hasPermissionTo('restore-guestPreference');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GuestPreference $guestPreference): bool
    {
        return $user->hasPermissionTo('force-delete-guestPreference');
    }
}
