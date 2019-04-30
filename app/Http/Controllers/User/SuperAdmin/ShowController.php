<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\SuperAdmin;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, SuperAdmin $superadmin): View
    {
        return view(
            'user.superadmin.show',
            ['superadmin' => $superadmin]
        );
    }
}
