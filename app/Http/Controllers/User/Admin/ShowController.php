<?php

namespace App\Http\Controllers\User\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Admin;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Admin $admin): View
    {
        // return $admin;
        // $this->authorize('view', $worker);

        return view(
            'user.admin.show',
            ['admin' => $admin]
        );
    }
}
