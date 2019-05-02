<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Event;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Worker, Legend};

class CreateController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * 
     * @param Worker $worker Worker
     *
     * @return View
     */
    public function __invoke(Worker $worker): View
    {
        return view(
            'user.worker.event.create', 
            [
                'worker' => $worker,
                'legends' => Legend::all_(),
                'workers' => Worker::all__(),
            ]
        );
    }
}
