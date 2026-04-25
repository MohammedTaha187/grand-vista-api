<?php

namespace Modules\Hotel\Policies\BookingRoom;

use Modules\Hotel\Models\BookingRoom;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingRoomPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-bookingRoom');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BookingRoom $bookingRoom): bool
    {
        return $user->hasPermissionTo('view-bookingRoom');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-bookingRoom');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BookingRoom $bookingRoom): bool
    {
        return $user->hasPermissionTo('update-bookingRoom');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BookingRoom $bookingRoom): bool
    {
        return $user->hasPermissionTo('delete-bookingRoom');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BookingRoom $bookingRoom): bool
    {
        return $user->hasPermissionTo('restore-bookingRoom');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BookingRoom $bookingRoom): bool
    {
        return $user->hasPermissionTo('force-delete-bookingRoom');
    }
}
