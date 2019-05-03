<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Event;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Event;

class ShowController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Event $event Event
     * 
     * @return View
     */
    public function __invoke(Event $event): View
    {
        return view(
            'calendar.event.show',
            ['event' => $event]
        );
    }
}
