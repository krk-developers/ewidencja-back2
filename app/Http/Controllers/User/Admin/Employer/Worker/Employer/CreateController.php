<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin\Employer\Worker\Employer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Admin, Employer, Worker};

/**
 * Adding an employer to the worker.
 */
class CreateController extends Controller
{
    /**
     * Show add form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Admin $admin, Employer $employer, Worker $worker): View
    {
        $employers = Employer::all__();
        
        return view(
            'user.admin.employer.worker.employer.create',
            [
                'admin' => $admin,
                'employer' => $employer,
                'worker' => $worker,
                'employers' => $employers,
            ]
        );
    }
}
