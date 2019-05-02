<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\{Worker, Event};

class DestroyController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request Request
     * @param Worker  $worker  Worker
     * @param Event   $event   Event
     * 
     * @return View|RedirectResponse
     */
    public function __invoke(Request $request, Worker $worker, Event $event): object
    {
        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            $event->destroy_($event->id);

            return redirect()
                ->route('workers.events.index', $worker->id)
                ->with('success', 'Usunięto');
            
        }

        if ($delete == 'No') {
            return redirect()
                ->route(
                    'workers.events.show',
                    [$worker->id, $event->id]
                )
                ->with('info', 'Nie usunięto');
        }

        return view(
            'user.worker.event.destroy',
            [
                'worker' => $worker,
                'event' => $event,
            ]
        );
    }
}
