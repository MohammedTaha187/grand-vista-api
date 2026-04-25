<?php

namespace Modules\Hotel\Policies\Amenity;

use Modules\Hotel\Models\Amenity;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AmenityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-amenity');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Amenity $amenity): bool
    {
        return $user->hasPermissionTo('view-amenity');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-amenity');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Amenity $amenity): bool
    {
        return $user->hasPermissionTo('update-amenity');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Amenity $amenity): bool
    {
        return $user->hasPermissionTo('delete-amenity');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Amenity $amenity): bool
    {
        return $user->hasPermissionTo('restore-amenity');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Amenity $amenity): bool
    {
        return $user->hasPermissionTo('force-delete-amenity');
    }
}
