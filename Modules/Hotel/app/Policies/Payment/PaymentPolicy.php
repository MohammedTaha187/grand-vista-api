<?php

namespace Modules\Hotel\Policies\Payment;

use Modules\Hotel\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-payment');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Payment $payment): bool
    {
        return $user->hasPermissionTo('view-payment');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-payment');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Payment $payment): bool
    {
        return $user->hasPermissionTo('update-payment');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Payment $payment): bool
    {
        return $user->hasPermissionTo('delete-payment');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Payment $payment): bool
    {
        return $user->hasPermissionTo('restore-payment');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Payment $payment): bool
    {
        return $user->hasPermissionTo('force-delete-payment');
    }
}
