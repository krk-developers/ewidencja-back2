<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Worker;

class WorkerPolicy
{
    use HandlesAuthorization;

    public function show()
    {
        die("I'm being called...");
        // return false; // $worker->id === Auth::user()->userable->id;
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

        // dd($user->userable_id);
        // dd($worker->id);
        // die($user);
        return $user->userable_id === $worker->id;
    }

    /**
     * Determine whether the user can create workers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
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
        //
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
        if ($user->type->name == 'worker') {
            return false;
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
