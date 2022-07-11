<?php

namespace Modules\Morphling\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Morphling\Models\Module;

class ModulePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewAny()
    {
        return true;
    }

    public function view(User $user, Module $module)
    {
        return true;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Module $module)
    {
        return false;
    }

    public function delete(User $user, Module $module)
    {
        return false;
    }

    public function runAction()
    {
        return true;
    }

    public function runDestructiveAction()
    {
        return true;
    }
}
