<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Legend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Legend;

class CreateController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return View $view View
     */
    public function __invoke(): View
    {
        $this->authorize('create', Legend::class);

        return view('calendar.legend.create');
    }
}
