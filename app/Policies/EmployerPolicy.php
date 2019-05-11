<?php

namespace App\Policies;

use App\User;
use App\Employer;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployerPolicy
{
    use HandlesAuthorization;

    public function showEmployersList(User $user)  // , Worker $worker
    {
        if ($user->type->name === 'employer') {
            return false;
        }

        return true;
    }
    /**
     * Determine whether the user can view the employer.
     *
     * @param  \App\User  $user
     * @param  \App\Employer  $employer
     * @return mixed
     */
    public function view(User $user, Employer $employer)
    {
        //
    }

    /**
     * Determine whether the user can create employers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the employer.
     *
     * @param  \App\User  $user
     * @param  \App\Employer  $employer
     * @return mixed
     */
    public function update(User $user, Employer $employer)
    {
        //
    }

    /**
     * Determine whether the user can delete the employer.
     *
     * @param  \App\User  $user
     * @param  \App\Employer  $employer
     * @return mixed
     */
    public function delete(User $user, Employer $employer)
    {
        //
    }

    /**
     * Determine whether the user can restore the employer.
     *
     * @param  \App\User  $user
     * @param  \App\Employer  $employer
     * @return mixed
     */
    public function restore(User $user, Employer $employer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the employer.
     *
     * @param  \App\User  $user
     * @param  \App\Employer  $employer
     * @return mixed
     */
    public function forceDelete(User $user, Employer $employer)
    {
        //
    }
}
