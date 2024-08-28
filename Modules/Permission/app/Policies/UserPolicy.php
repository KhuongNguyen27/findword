<?php

namespace Modules\Permission\app\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use app\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
       return $user->hasPermission('user_viewAny');
    }
    public function view(User $user)
    {
        return $user->hasPermission('user_view');
    }
    public function create(User $user)
    {
        return $user->hasPermission('user_create');
    }
    public function update(User $user)
    {
        return $user->hasPermission('user_update');
    }
    public function delete(User $user)
    {
        return $user->hasPermission('user_delete');
    }



    public function viewAnySystem(User $user)
    {
       return $user->hasPermission('user_viewAnySystem');
    }
    public function viewSystem(User $user)
    {
        return $user->hasPermission('user_viewSystem');
    }
    public function createSystem(User $user)
    {
        return $user->hasPermission('user_createSystem');
    }
    public function updateSystem(User $user)
    {
        return $user->hasPermission('user_updateSystem');
    }
    public function deleteSystem(User $user)
    {
        return $user->hasPermission('user_deleteSystem');
    }



    public function viewAnyPost(User $user)
    {
       return $user->hasPermission('user_viewAnyPost');
    }
    public function viewPost(User $user)
    {
        return $user->hasPermission('user_viewPost');
    }
    public function createPost(User $user)
    {
        return $user->hasPermission('user_createPost');
    }
    public function updatePost(User $user)
    {
        return $user->hasPermission('user_updatePost');
    }
    public function deletePost(User $user)
    {
        return $user->hasPermission('user_deletePost');
    }

    public function homeView(User $user)
    {
        return $user->hasPermission('home_viewAny');
    }
}
