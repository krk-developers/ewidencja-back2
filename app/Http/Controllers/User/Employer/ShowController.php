<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Employer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Carbon\Carbon;
use App\Employer;

class ShowController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Employer $employer Employer
     * 
     * @return View
     */
    public function __invoke(Employer $employer): View
    {
        $this->authorize('view', $employer);
        
        return view(
            'user.employer.show',
            [
                'employer' => $employer,
                'year_month' => Carbon::now()->format('Y-m'),
                'month_name' => Carbon::now()->monthName,
            ]
        );
    }
}
