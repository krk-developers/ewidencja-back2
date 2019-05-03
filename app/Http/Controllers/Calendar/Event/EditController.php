<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Event;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Event, Legend, Worker};

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Event $event Event
     * 
     * @return View
     */
    public function __invoke(Event $event): View
    {
        return view(
            'calendar.event.edit',
            [
                'event' => $event,
                'legends' => Legend::all_(),
                'workers' => Worker::all__(),
            ]
        );
    }
}
