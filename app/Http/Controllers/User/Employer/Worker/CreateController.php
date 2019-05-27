<?php

namespace App\Http\Controllers\User\Employer\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{ Employer, Worker };

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Employer $employer)
    {
        // return __CLASS__;
        // $workers = Worker::all__();
        $workers = Worker::allSortBy();
        // return $workers->user->name;
        // return $workers;
        return view(
            'user.employer.worker.create',
            [
                'employer' => $employer,
                'workers' => $workers,
            ]
        );
    }
}
