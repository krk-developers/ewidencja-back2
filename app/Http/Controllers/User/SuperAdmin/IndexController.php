<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\SuperAdmin;

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
    public function __invoke(): View
    {
        // return __FUNCTION__;
        $users = User::byType('superadmin');
        // return $users;
        return view(
            'user.superadmin.index',
            ['users' => $users]
        );
    }
}
