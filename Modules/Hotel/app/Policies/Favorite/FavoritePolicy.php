<?php

namespace Modules\Hotel\Policies\Favorite;

use Modules\Hotel\Models\Favorite;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoritePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-favorite');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Favorite $favorite): bool
    {
        return $user->hasPermissionTo('view-favorite');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-favorite');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Favorite $favorite): bool
    {
        return $user->hasPermissionTo('update-favorite');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Favorite $favorite): bool
    {
        return $user->hasPermissionTo('delete-favorite');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Favorite $favorite): bool
    {
        return $user->hasPermissionTo('restore-favorite');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Favorite $favorite): bool
    {
        return $user->hasPermissionTo('force-delete-favorite');
    }
}
