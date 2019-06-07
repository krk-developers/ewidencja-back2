<?php

namespace App\Http\Controllers\User\Admin\Employer\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Admin, Employer, Worker};

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Admin $admin, Employer $employer)
    {
        // return __CLASS__;
        $workers = Worker::allSortBy();

        return view(
            'user.admin.employer.worker.create',
            [
                'admin' => $admin,
                'employer' => $employer,
                'workers' => $workers,
            ]
        );
    }
}
