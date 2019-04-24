<?php

namespace App\Http\Controllers\User\Worker;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Worker;

class ShowController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Worker $worker Worker
     * 
     * @return View
     */
    public function __invoke(Worker $worker): View
    {
        $this->authorize('view', $worker);

        return view(
            'user.worker.show',
            ['worker' => $worker]
        );
    }
}
