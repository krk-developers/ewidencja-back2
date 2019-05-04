<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Admin;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function __invoke(): View  // Request $request
    {
        // $users = User::byType('admin');
        // return $users;
        $admins = Admin::all_();

        return view(
            'user.admin.index',
            ['admins' => $admins]
        );
    }
}
