<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CreateController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return View $view View
     */
    public function __invoke(): View  // Request $request
    {
        // return __FUNCTION__;
        return view('user.worker.create');
    }
}
