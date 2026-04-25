<?php

namespace Modules\Cms\Policies\Faq;

use Modules\Cms\Models\Faq;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaqPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-faq');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Faq $faq): bool
    {
        return $user->hasPermissionTo('view-faq');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-faq');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Faq $faq): bool
    {
        return $user->hasPermissionTo('update-faq');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Faq $faq): bool
    {
        return $user->hasPermissionTo('delete-faq');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Faq $faq): bool
    {
        return $user->hasPermissionTo('restore-faq');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Faq $faq): bool
    {
        return $user->hasPermissionTo('force-delete-faq');
    }
}
