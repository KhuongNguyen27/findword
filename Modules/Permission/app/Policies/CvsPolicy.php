<?php

namespace Modules\Permission\app\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class CvsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
}
