<?php

namespace Modules\Cms\Policies\Offer;

use Modules\Cms\Models\Offer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-offer');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Offer $offer): bool
    {
        return $user->hasPermissionTo('view-offer');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-offer');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Offer $offer): bool
    {
        return $user->hasPermissionTo('update-offer');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Offer $offer): bool
    {
        return $user->hasPermissionTo('delete-offer');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Offer $offer): bool
    {
        return $user->hasPermissionTo('restore-offer');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Offer $offer): bool
    {
        return $user->hasPermissionTo('force-delete-offer');
    }
}
