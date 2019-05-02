<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
// use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
// use App\User;

class UserComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    // protected $user;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    /*
    public function __construct(User $user)
    {
        // Dependencies automatically resolved by service container...
        $this->user = $user;
    }
    */
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('user', Auth::user());
    }
}
