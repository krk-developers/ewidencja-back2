<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Event;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Legend, Employer, Worker};

class CreateController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * 
     * @param Worker   $worker   Worker
     * @param Employer $employer Employer
     *
     * @return View
     */
    public function __invoke(Worker $worker, Employer $employer): View
    {
        return view(
            'user.worker.event.create', 
            [
                'worker' => $worker,
                'legends' => Legend::allSortBy(),
                'workers' => Worker::all__(),
                'employer' => $employer,
            ]
        );
    }
}
