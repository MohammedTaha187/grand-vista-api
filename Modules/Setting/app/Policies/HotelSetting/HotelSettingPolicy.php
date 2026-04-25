<?php

namespace Modules\Setting\Policies\HotelSetting;

use Modules\Setting\Models\HotelSetting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HotelSettingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-hotelSetting');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, HotelSetting $hotelSetting): bool
    {
        return $user->hasPermissionTo('view-hotelSetting');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-hotelSetting');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, HotelSetting $hotelSetting): bool
    {
        return $user->hasPermissionTo('update-hotelSetting');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, HotelSetting $hotelSetting): bool
    {
        return $user->hasPermissionTo('delete-hotelSetting');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, HotelSetting $hotelSetting): bool
    {
        return $user->hasPermissionTo('restore-hotelSetting');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, HotelSetting $hotelSetting): bool
    {
        return $user->hasPermissionTo('force-delete-hotelSetting');
    }
}
