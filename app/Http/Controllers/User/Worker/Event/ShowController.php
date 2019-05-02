<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Event;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Worker, Event};

class ShowController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Worker $worker Worker
     * @param Event  $event  Event
     * 
     * @return View
     */
    public function __invoke(Worker $worker, Event $event): View
    {
        return view(
            'user.worker.event.show',
            [
                'worker' => $worker,
                'event' => $event,
            ]
        );
    }
}
