<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Employer;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Collection;
use App\{Worker, Employer};

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Worker $worker, Employer $employer)  // Request $request
    {
        // return $employer;
        // return $worker;
        // return $worker->employers;//[0]->withPivot('contract_from');
        // $p = $worker->belongsToMany('App\Employer')->withPivot('contract_from');
        // dd($p->pivotColumns);
        //echo $p;
        $collection = collect($worker->employers);
        $employerInformation = $collection->firstWhere('id', $employer->id);
        // return $employerInformation;
        // return $c->pivot->contract_from;//->pivot;
        // return __CLASS__;
        return view(
            'user.worker.employer.show',
            [
                'worker' => $worker,
                'employer' => $employer,
                'employer_information' => $employerInformation
            ]
        );
    }
}
