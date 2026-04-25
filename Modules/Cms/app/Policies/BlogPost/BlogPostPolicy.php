<?php

namespace Modules\Cms\Policies\BlogPost;

use Modules\Cms\Models\BlogPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-any-blogPost');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BlogPost $blogPost): bool
    {
        return $user->hasPermissionTo('view-blogPost');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-blogPost');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BlogPost $blogPost): bool
    {
        return $user->hasPermissionTo('update-blogPost');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BlogPost $blogPost): bool
    {
        return $user->hasPermissionTo('delete-blogPost');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BlogPost $blogPost): bool
    {
        return $user->hasPermissionTo('restore-blogPost');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BlogPost $blogPost): bool
    {
        return $user->hasPermissionTo('force-delete-blogPost');
    }
}
