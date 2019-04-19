<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\User;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function __invoke(): View  // Request $request
    {
        $users = User::byType('worker');
        // return $users;
        return view(
            'user.worker.index',
            ['users' => $users]
        );
    }
}
