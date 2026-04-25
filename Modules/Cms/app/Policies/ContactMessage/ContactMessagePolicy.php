<?php

namespace Modules\Cms\Policies\ContactMessage;

use Modules\Cms\Models\ContactMessage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactMessagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-contactMessage');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ContactMessage $contactMessage): bool
    {
        return $user->hasPermissionTo('view-contactMessage');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-contactMessage');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ContactMessage $contactMessage): bool
    {
        return $user->hasPermissionTo('update-contactMessage');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ContactMessage $contactMessage): bool
    {
        return $user->hasPermissionTo('delete-contactMessage');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ContactMessage $contactMessage): bool
    {
        return $user->hasPermissionTo('restore-contactMessage');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ContactMessage $contactMessage): bool
    {
        return $user->hasPermissionTo('force-delete-contactMessage');
    }
}
