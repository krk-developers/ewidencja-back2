<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Event;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Event;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return View
     */
    public function __invoke(): View
    {
        $events = Event::all_();

        return view(
            'calendar.event.index',
            ['events' => $events]
        );
    }
}
