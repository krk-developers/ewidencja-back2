<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin\Employer;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Admin;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Admin $admin)  // Request $request
    {
        // return __CLASS__;
        
        return view('user.admin.employer.index', ['admin' => $admin]);
    }
}
