<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Employer\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreEvent;
use App\{Worker, Employer, Event};
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEvent $request    Validation
     * @param Worker     $worker     Worker
     * @param Employer   $employer   Employer
     * @param string     $year_month YYYY-MM
     * 
     * @return RedirectResponse
     */
    public function __invoke(
        StoreEvent $request,
        Worker $worker,
        Employer $employer,
        string $year_month
    ): RedirectResponse {
        $validated = $request->validated();

        $event = Event::createRow($validated);

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
