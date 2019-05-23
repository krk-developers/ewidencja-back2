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
     * Show the form for editing the specified resource.
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
                'legends' => Legend::allSortBy(),
                'workers' => Worker::all__(),
            ]
        );
    }
}
