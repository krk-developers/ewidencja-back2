<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Employer\Worker;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Employer, Worker};

class EditController extends Controller
{
    /**
     * Show employer's worker edit form.
     *
     * @param Employer $employer Employer
     * @param Worker   $worker   Worker
     * 
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Employer $employer, Worker $worker): View
    {
        return view(
            'user.employer.worker.edit',
            [
                'employer' => $employer,
                'worker' => $worker,
            ]
        );
    }
}
