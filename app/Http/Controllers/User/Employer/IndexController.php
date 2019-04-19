<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Employer;

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
        $users = User::byType('employer');
        // return $users;
        return view(
            'user.employer.index',
            ['users' => $users]
        );
    }
}
