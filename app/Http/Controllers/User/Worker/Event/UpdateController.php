<?php

namespace App\Http\Controllers\User\Worker\Event;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreEvent;
use App\{Worker, Event};

class UpdateController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param StoreEvent $request Validation
     * @param Worker     $worker  Worker 
     * @param Event      $event   Event
     * 
     * @return RedirectResponse
     */
    public function __invoke(
        StoreEvent $request,
        Worker $worker,
        Event $event
    ): RedirectResponse {
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
            ->route('workers.events.show', [$worker->id, $event->id])
            ->with($status, $message);
    }
}
