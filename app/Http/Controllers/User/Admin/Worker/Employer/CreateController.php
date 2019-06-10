<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin\Worker\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Admin, Employer, Worker};

/**
 * Adds the employer to the worker.
 */
class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Admin $admin, Worker $worker)//: View  // Request $request,
    {
        // return __CLASS__;
        // $this->authorize('addEmployer', Worker::class);
        
        $employers = Employer::all__();
        
        return view(
            'user.admin.worker.employer.create',
            [
                'admin' => $admin,
                'worker' => $worker,
                'employers' => $employers,
            ]
        );
    }
}
