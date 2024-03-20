<?php

namespace Modules\Permission\app\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Module\Permisson\app\Models\User;
use Module\AdminHome\app\Models\AdminHome;

class AdminHomePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
       return $user->hasPermission('AdminHome_viewAny');
    }
    public function view(User $user)
    {
        return $user->hasPermission('AdminHome_view');
    }
    public function create(User $user)
    {
        return $user->hasPermission('AdminHome_create');
    }
    public function update(User $user)
    {
        return $user->hasPermission('AdminHome_update');
    }
    public function delete(User $user)
    {
        return $user->hasPermission('AdminHome_delete');
    }
}