<?php

namespace App\Http\Controllers\User\Worker\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreEvent;
use App\{Event, Worker, Employer};

class StoreController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEvent $request  Validation
     * @param Worker     $worker   Worker
     * @param Employer   $employer Employer
     * 
     * @return RedirectResponse
     */
    public function __invoke(StoreEvent $request, Worker $worker, Employer $employer): RedirectResponse
    {
        // return $request;
        $validated = $request->validated();

        Event::create_($request->all());
        
        return redirect()
            ->route('workers.events.index', $worker->id)
            ->with('success', 'Dodano');
    }
}
