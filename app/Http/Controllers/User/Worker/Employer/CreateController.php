<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Employer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Worker;
use App\Employer;

class CreateController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Worker $worker Worker
     * 
     * @return View
     */
    public function __invoke(Worker $worker): View
    {
        $this->authorize('addEmployer', Worker::class);
        
        $employers = Employer::all__();
        
        return view(
            'user.worker.employer.create',
            [
                'employers' => $employers,
                'worker' => $worker,
            ]
        );
    }
}
