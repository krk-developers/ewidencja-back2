<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin\Employer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Admin;

class IndexController extends Controller
{
    /**
     * List of employers witch was added to admin.
     *
     * @param Admin $admin Admin
     * 
     * @return View
     */
    public function __invoke(Admin $admin): View
    {
        return view('user.admin.employer.index', ['admin' => $admin]);
    }
}
