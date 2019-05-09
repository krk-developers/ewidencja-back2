<?php

namespace App\Http\Controllers\User\Worker\Employer\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvent;
use App\{Worker, Employer, Event};

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreEvent $request, Worker $worker, Employer $employer, Event $event, string $year_month)
    {
        // return __CLASS__;
        $validated = $request->validated();
        
        $saved = false;

        $event->fill($request->all());
        if ($event->isDirty()) {
            $saved = $event->save();  // bool
        }

        if ($saved) {
            $status = 'success';
            $message = "Zmieniono";
        } else {
            $status = 'info';
            $message = "Nie zmieniono";
        }

        return redirect()
            ->route('workers.employers.events.show', [$worker->id, $employer->id, $event->id, $year_month])
            ->with($status, $message);
    }
}
