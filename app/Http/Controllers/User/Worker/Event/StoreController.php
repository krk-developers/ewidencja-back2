<?php

namespace App\Http\Controllers\User\Worker\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvent;
use App\{Worker, Event};

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreEvent $request, Worker $worker)
    {
        $validated = $request->validated();
        // return $request;

        Event::create_($request->all());
        
        return redirect()
            ->route('workers.events.index', $worker->id)
            ->with('success', 'Dodano');
    }
}
