<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\User;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return View
     */
    public function __invoke(): View
    {
        // $this->authorize('create', Auth::user());

        return view('user.admin.create');
    }
}
