<?php

namespace App\Http\Controllers\User\Employer\Worker;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{ Employer, Worker };

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Employer $employer Employer
     * 
     * @return View
     */
    public function __invoke(Employer $employer): View
    {
        $this->authorize('addWorker', $employer);

        $workers = Worker::allSortBy();

        return view(
            'user.employer.worker.create',
            [
                'employer' => $employer,
                'workers' => $workers,
            ]
        );
    }
}
