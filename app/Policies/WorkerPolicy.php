<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Worker;

class WorkerPolicy
{
    use HandlesAuthorization;
    
    public function before(User $user)
    {
        if ($user->type->name === 'superadmin') {
            return true;
        }

        /*
        if ($user->type->name === 'admin') {
            return true;
        }
        */
    }
    
    public function list(User $user)
    {
        if ($user->type->name === 'superadmin') {
            return true;
        }
        
        /*
        if ($user->type->name === 'admin') {
            return true;
        }
        */
    }

    /**
     * Determine whether the user can view the worker.
     *
     * @param  \App\User  $user
     * @param  \App\Worker  $worker
     * @return mixed
     */
    public function view(User $user, Worker $worker)
    {
        if ($user->type->name === 'worker') {
            return $user->userable_id === $worker->id;
        }
        
        return true;
    }

    /**
     * Determine whether the user can create workers.
     *
     * @param  \App\User  $user
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
     * Determine whether the user can update the worker.
     *
     * @param  \App\User  $user
     * @param  \App\Worker  $worker
     * @return mixed
     */
    public function update(User $user, Worker $worker)
    {
        if ($user->type->name === 'employer') {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the worker.
     *
     * @param  \App\User  $user
     * @param  \App\Worker  $worker
     * @return mixed
     */
    public function delete(User $user, Worker $worker)
    {
        // worker can not delete their profile
    }

    public function addEmployer(User $user)
    {
        if ($user->type->name === 'superadmin') {
            return true;
        }

        if ($user->type->name === 'admin') {
            return true;
        }
    }

    public function removeEmployer(User $user)
    {
        if ($user->type->name === 'superadmin') {
            return true;
        }

        if ($user->type->name === 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the worker.
     *
     * @param  \App\User  $user
     * @param  \App\Worker  $worker
     * @return mixed
     */
    public function restore(User $user, Worker $worker)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the worker.
     *
     * @param  \App\User  $user
     * @param  \App\Worker  $worker
     * @return mixed
     */
    public function forceDelete(User $user, Worker $worker)
    {
        //
    }
}
