<?php

namespace Modules\Hotel\Policies\BookingAddon;

use Modules\Hotel\Models\BookingAddon;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingAddonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-bookingAddon');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BookingAddon $bookingAddon): bool
    {
        return $user->hasPermissionTo('view-bookingAddon');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-bookingAddon');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BookingAddon $bookingAddon): bool
    {
        return $user->hasPermissionTo('update-bookingAddon');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BookingAddon $bookingAddon): bool
    {
        return $user->hasPermissionTo('delete-bookingAddon');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BookingAddon $bookingAddon): bool
    {
        return $user->hasPermissionTo('restore-bookingAddon');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BookingAddon $bookingAddon): bool
    {
        return $user->hasPermissionTo('force-delete-bookingAddon');
    }
}
