<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Employer\Event;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Worker, Employer, Legend};

class CreateController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Worker $worker Worker
     * @param Employer $employer Employer
     * @param string $year_month Year and month. Format: YYYY-MM
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Worker $worker, Employer $employer, string $year_month)//: use Illuminate\View\View;  // Request $request,
    {
        // return __CLASS__;
        return view(
            'user.worker.employer.event.create', 
            [
                'worker' => $worker,
                'employer' => $employer,
                'year_month' => $year_month,
                'legends' => Legend::all_(),
                'workers' => Worker::all__(),
            ]
        );
    }
}
