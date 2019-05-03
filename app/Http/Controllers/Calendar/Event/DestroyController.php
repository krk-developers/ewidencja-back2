<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Event;

class DestroyController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request Request
     * @param Event   $event   Event
     * 
     * @return View|RedirectResponse
     */
    public function __invoke(Request $request, Event $event): object
    {
        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            $event->destroy_($event->id);

            return redirect()
                ->route('events.index', $event->id)
                ->with('success', 'Usunięto');
            
        }

        if ($delete == 'No') {
            return redirect()
                ->route('events.show', $event->id)
                ->with('info', 'Nie usunięto');
        }

        return view(
            'calendar.event.destroy', ['event' => $event]
        );
    }
}
