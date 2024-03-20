<?php

namespace Modules\Permission\app\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use app\Models\User;
use Modules\AdminPost\app\Models\AdminPost;

class AdminPostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermission('AdminPost_viewAny');
    }
    public function view(User $user)
    {
        return $user->hasPermission('AdminPost_view');
    }
    public function create(User $user)
    {
        return $user->hasPermission('AdminPost_create');
    }
    public function update(User $user)
    {
        return $user->hasPermission('AdminPost_update');
    }
    public function delete(User $user)
    {
        return $user->hasPermission('AdminPost_delete');
    }
}