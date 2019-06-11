<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Employer\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Carbon\Carbon;
use App\{Employer, Worker};

class ShowController extends Controller
{
    /**
     * Show employer's worker profile
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Employer $employer, Worker $worker): View  // Request $request
    {
        // $this->authorize('view', $worker);
        // return __CLASS__;
        return view(
            'user.employer.worker.show',
            [
                'employer' => $employer,
                'worker' => $worker,
                'year_month' => Carbon::now()->format('Y-m'),
                'month_name' => Carbon::now()->monthName,
            ]
        );
    }
}
