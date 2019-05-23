<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Event;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Legend, Worker, Employer};

class CreateController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function __invoke(): View
    {
        return view(
            'calendar.event.create', 
            [
                'legends' => Legend::allSortBy(),
                'workers' => Worker::all__(),
                'employers' => Employer::allSortBy(),
            ]
        );
    }
}
