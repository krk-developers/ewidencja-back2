<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\{SuperAdmin, Admin};

class AdminPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->type->name === 'superadmin') {
            return true;
        }
    }

    public function list(User $user)
    {
        if ($user->type->name === 'superadmin') {
            return true;
        }

        if ($user->type->name === 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view the admin.
     *
     * @param  \App\User  $user
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function view(User $user, Admin $admin)
    {
        return ($user->userable_id === $admin->id);  // && $user->type->name == 'admin'
    }

    /**
     * Determine whether the user can create admins.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->type->name === 'superadmin') {
            return true;
        }
    }

    /**
     * Determine whether the user can update the admin.
     *
     * @param  \App\User  $user
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function update(User $user, Admin $admin)
    {
        return ($user->userable_id === $admin->id);
    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @param  \App\User  $user
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function delete(User $user, Admin $admin)
    {
        return $user->userable_id === $admin->id;
    }

    /**
     * Determine whether the user can restore the admin.
     *
     * @param  \App\User  $user
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function restore(User $user, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the admin.
     *
     * @param  \App\User  $user
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function forceDelete(User $user, Admin $admin)
    {
        //
    }
}
