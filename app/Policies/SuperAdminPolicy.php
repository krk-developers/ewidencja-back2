<?php

namespace App\Policies;

use App\User;
use App\SuperAdmin;
use Illuminate\Auth\Access\HandlesAuthorization;

class SuperAdminPolicy
{
    use HandlesAuthorization;

    public function list(User $user)
    {
        if ($user->type->name === 'superadmin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view the super admin.
     *
     * @param  \App\User  $user
     * @param  \App\SuperAdmin  $superAdmin
     * @return mixed
     */
    public function view(User $user, SuperAdmin $superAdmin)
    {
        if ($user->type->name === 'superadmin') {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create super admins.
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
     * Determine whether the user can update the super admin.
     *
     * @param  \App\User  $user
     * @param  \App\SuperAdmin  $superAdmin
     * @return mixed
     */
    public function update(User $user, SuperAdmin $superAdmin)
    {
        return $user->userable_id === $superAdmin->id;
    }

    /**
     * Determine whether the user can delete the super admin.
     *
     * @param  \App\User  $user
     * @param  \App\SuperAdmin  $superAdmin
     * @return mixed
     */
    public function delete(User $user, SuperAdmin $superAdmin)
    {
        return $user->userable_id === $superAdmin->id;
    }

    /**
     * Determine whether the user can restore the super admin.
     *
     * @param  \App\User  $user
     * @param  \App\SuperAdmin  $superAdmin
     * @return mixed
     */
    public function restore(User $user, SuperAdmin $superAdmin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the super admin.
     *
     * @param  \App\User  $user
     * @param  \App\SuperAdmin  $superAdmin
     * @return mixed
     */
    public function forceDelete(User $user, SuperAdmin $superAdmin)
    {
        //
    }
}
