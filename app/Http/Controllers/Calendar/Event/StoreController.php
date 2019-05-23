<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Event;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreEvent;
use App\Event;

class StoreController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEvent $request Validation
     * 
     * @return RedirectResponse
     */
    public function __invoke(StoreEvent $request): RedirectResponse
    {
        $validated = $request->validated();

        Event::createRow($request->all());
        
        return redirect()
            ->route('events.index')
            ->with('success', 'Dodano');
    }
}
