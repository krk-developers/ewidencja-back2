<?php

namespace App\Http\Controllers\User\Worker\Employer\Event;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvent;
use App\{Worker, Employer, Event};

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreEvent $request, Worker $worker, Employer $employer, string $year_month)
    {
        // return __CLASS__;
        // return $request;
        $validated = $request->validated();
        // return $validated;
        // Event::create_($request->all());

        $event = Event::create_($validated);

        if ($event) {
            $info = 'success';
            $message = 'Dodano';
        } else {
            $info = 'info';
            $message = 'Nie dodano';
        }
        
              
        return redirect()
            ->route(
                'workers.employers.events.index',
                [
                    $worker->id,
                    $employer->id,
                    $year_month
                ]
            )
            ->with($info, $message);
    }
}
