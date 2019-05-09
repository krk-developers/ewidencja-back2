<?php

namespace App\Http\Controllers\User\Worker\Employer\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Worker, Employer, Legend};

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Worker $worker, Employer $employer, string $year_month)
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
