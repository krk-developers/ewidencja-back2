<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin\Employer\Worker;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Admin, Employer, Worker};

/**
 * Adds the worker to the employer
 */
class CreateController extends Controller
{
    /**
     * Show the form of adding a worker to the employer.
     *
     * @param Admin    $admin    Admin
     * @param Employer $employer Employer
     * 
     * @return View
     */
    public function __invoke(Admin $admin, Employer $employer): View
    {
        $workers = Worker::allSortBy();

        return view(
            'user.admin.employer.worker.create',
            [
                'admin' => $admin,
                'employer' => $employer,
                'workers' => $workers,
            ]
        );
    }
}
