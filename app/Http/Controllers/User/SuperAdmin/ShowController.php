<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\SuperAdmin;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param SuperAdmin $superadmin SuperAdmin
     * 
     * @return View
     */
    public function __invoke(SuperAdmin $superadmin): View
    {
        $this->authorize('view', $superadmin);

        return view(
            'user.superadmin.show',
            ['superadmin' => $superadmin]
        );
    }
}
