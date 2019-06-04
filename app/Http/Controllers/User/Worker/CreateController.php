<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Worker;

class CreateController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return View $view View
     */
    public function __invoke(): View
    {
        $this->authorize('create', Worker::class);

        return view('user.worker.create');
    }
}
