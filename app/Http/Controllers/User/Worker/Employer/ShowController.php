<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Worker;
use App\Employer;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Worker $worker)//: View
    {
        $employers = Employer::all__();
        // return $employers;
        return view(
            'user.worker.add_employer.show',
            [
                'employers' => $employers,
                'worker' => $worker,
            ]
        );
    }
}
