<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\{User, Legend};

class LegendPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any legends.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the legend.
     *
     * @param  \App\User  $user
     * @param  \App\Legend  $legend
     * @return mixed
     */
    public function view(User $user, Legend $legend)
    {
        if ($user->type->name === 'superadmin') {
            return true;
        }

        if ($user->type->name === 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can create legends.
     *
     * @param User $user User
     * 
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->type->name === 'superadmin') {
            return true;
        }

        if ($user->type->name === 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can update the legend.
     *
     * @param User   $user   User
     * @param Legend $legend Legend
     * 
     * @return mixed
     */
    public function update(User $user, Legend $legend)
    {
        if ($user->type->name === 'superadmin') {
            return true;
        }

        if ($user->type->name === 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the legend.
     *
     * @param User   $user   User
     * @param Legend $legend Legend
     * 
     * @return mixed
     */
    public function delete(User $user, Legend $legend)
    {
        if ($user->type->name === 'superadmin') {
            return true;
        }

        if ($user->type->name === 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the legend.
     *
     * @param  \App\User  $user
     * @param  \App\Legend  $legend
     * @return mixed
     */
    public function restore(User $user, Legend $legend)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the legend.
     *
     * @param  \App\User  $user
     * @param  \App\Legend  $legend
     * @return mixed
     */
    public function forceDelete(User $user, Legend $legend)
    {
        //
    }
}
