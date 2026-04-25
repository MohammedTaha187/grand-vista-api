<?php

namespace Modules\Hotel\Policies\RoomType;

use Modules\Hotel\Models\RoomType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-roomType');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RoomType $roomType): bool
    {
        return $user->hasPermissionTo('view-roomType');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-roomType');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RoomType $roomType): bool
    {
        return $user->hasPermissionTo('update-roomType');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RoomType $roomType): bool
    {
        return $user->hasPermissionTo('delete-roomType');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RoomType $roomType): bool
    {
        return $user->hasPermissionTo('restore-roomType');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RoomType $roomType): bool
    {
        return $user->hasPermissionTo('force-delete-roomType');
    }
}
