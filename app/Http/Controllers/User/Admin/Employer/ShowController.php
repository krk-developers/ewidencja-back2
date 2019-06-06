<?php

namespace App\Http\Controllers\User\Admin\Employer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Carbon\Carbon;
use App\{Admin, Employer};

class ShowController extends Controller
{
    /**
     * Show employer profile.
     *
     * @param Admin    $admin    Admin
     * @param Employer $employer Employer
     * 
     * @return View
     */
    public function __invoke(Admin $admin, Employer $employer): View
    {
        return view(
            'user.admin.employer.show',
            [
                'admin' => $admin,
                'employer' => $employer,
                'year_month' => Carbon::now()->format('Y-m'),
                'month_name' => Carbon::now()->monthName,
            ]
        );
    }
}
