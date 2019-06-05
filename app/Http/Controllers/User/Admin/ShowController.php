<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Admin;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Admin $admin Admin
     * 
     * @return View
     */
    public function __invoke(Admin $admin): View
    {
        $this->authorize('view', $admin);

        return view(
            'user.admin.show',
            ['admin' => $admin]
        );
    }
}
