<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Event;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Worker, Event, Legend};

class EditController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Worker $worker Worker
     * @param Event  $event  Event
     * 
     * @return View
     */
    public function __invoke(Worker $worker, Event $event): View
    {
        return view(
            'user.worker.event.edit',
            [
                'worker' => $worker,
                'event' => $event,
                'legends' => Legend::allSortBy(),
                'workers' => Worker::all__(),
            ]
        );
    }
}
