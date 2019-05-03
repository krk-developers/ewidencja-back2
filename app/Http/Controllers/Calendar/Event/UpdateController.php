<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Event;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreEvent;
use App\Event;

class UpdateController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param StoreEvent $request Validation
     * @param Event      $event   Event
     * 
     * @return RedirectResponse
     */
    public function __invoke(StoreEvent $request, Event $event): RedirectResponse
    {
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
            ->route('events.show', $event->id)
            ->with($status, $message);
    }
}
