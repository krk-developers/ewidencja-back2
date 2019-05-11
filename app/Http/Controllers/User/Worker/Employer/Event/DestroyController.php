<?php

namespace App\Http\Controllers\User\Worker\Employer\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Worker, Employer, Event};

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Worker $worker, Employer $employer, Event $event, string $year_month)
    {
        // return __CLASS__;
        // $this->authorize('delete', $worker);

        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            $event::destroy_($event->id);

            return redirect()
                ->route(
                    'workers.employers.events.index',
                    [
                        $worker->id,
                        $employer->id,
                        $year_month
                    ]
                )
                ->with('success', 'Usunięto');
            
        }

        if ($delete == 'No') {
            return redirect()
                ->route(
                    'workers.employers.events.show',
                    [
                        $worker->id,
                        $employer->id,
                        $event->id,
                        $year_month
                    ]
                );
        }

        return view(
            'user.worker.employer.event.destroy',
            [
                'worker' => $worker,
                'employer' => $employer,
                'event' => $event,
                'year_month' => $year_month,
            ]
        );
    }
}
