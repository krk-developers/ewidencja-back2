<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Admin;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return View
     */
    public function __invoke(): View
    {
        $this->authorize('create', Admin::class);

        return view('user.admin.create');
    }
}
