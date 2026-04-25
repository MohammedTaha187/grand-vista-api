<?php

namespace Modules\Cms\Policies\Testimonial;

use Modules\Cms\Models\Testimonial;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestimonialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-testimonial');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Testimonial $testimonial): bool
    {
        return $user->hasPermissionTo('view-testimonial');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-testimonial');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Testimonial $testimonial): bool
    {
        return $user->hasPermissionTo('update-testimonial');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Testimonial $testimonial): bool
    {
        return $user->hasPermissionTo('delete-testimonial');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Testimonial $testimonial): bool
    {
        return $user->hasPermissionTo('restore-testimonial');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Testimonial $testimonial): bool
    {
        return $user->hasPermissionTo('force-delete-testimonial');
    }
}
