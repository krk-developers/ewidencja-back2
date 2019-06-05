<?php

namespace App\Http\Controllers\User\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\SuperAdmin;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return View
     */
    public function __invoke(): View
    {
        $this->authorize('create', SuperAdmin::class);

        return view('user.superadmin.create');
    }
}
