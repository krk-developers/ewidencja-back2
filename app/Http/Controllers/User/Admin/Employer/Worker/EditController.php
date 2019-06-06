<?php

namespace App\Http\Controllers\User\Admin\Employer\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Admin, Employer, Worker};

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Admin $admin, Employer $employer, Worker $worker)
    {
        // return __CLASS__;
        return view(
            'user.admin.employer.worker.edit',
            [
                'admin' => $admin,
                'employer' => $employer,
                'worker' => $worker,
            ]
        );    
    }
}
