<?php

namespace Modules\Hotel\Policies\RoomAvailability;

use Modules\Hotel\Models\RoomAvailability;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomAvailabilityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-roomAvailability');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RoomAvailability $roomAvailability): bool
    {
        return $user->hasPermissionTo('view-roomAvailability');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-roomAvailability');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RoomAvailability $roomAvailability): bool
    {
        return $user->hasPermissionTo('update-roomAvailability');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RoomAvailability $roomAvailability): bool
    {
        return $user->hasPermissionTo('delete-roomAvailability');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RoomAvailability $roomAvailability): bool
    {
        return $user->hasPermissionTo('restore-roomAvailability');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RoomAvailability $roomAvailability): bool
    {
        return $user->hasPermissionTo('force-delete-roomAvailability');
    }
}
