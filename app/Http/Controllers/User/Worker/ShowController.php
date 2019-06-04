<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Worker;
use Carbon\Carbon;

class ShowController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Worker $worker Worker
     * 
     * @return View
     */
    public function __invoke(Worker $worker): View
    {
        $this->authorize('view', $worker);

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
