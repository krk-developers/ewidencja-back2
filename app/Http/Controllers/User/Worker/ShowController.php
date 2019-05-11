<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Worker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Collection;

class ShowController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Worker $worker Worker
     * 
     * @return View
     */
    public function __invoke(Worker $worker)//: View
    {
        // return __CLASS__;
        // return $user;
        // return $worker;
        // return $worker->employers->pluck('id');
        // return $id = Auth::id();
        $user = Auth::user();
        // return $user->userable_id;
        // return $worker->employers->pluck('id');

        // return $user->userable_id;
        
        $this->authorize('view', $worker);
        // $this->authorize('employerViewWorker');
        // $this->authorize('delete', $worker);

        return view(
            'user.worker.show',
            [
                'worker' => $worker,
                'year_month' => Carbon::now()->format('Y-m'),
                'month_name' => Carbon::now()->monthName,
            ]
        );
    }
}
