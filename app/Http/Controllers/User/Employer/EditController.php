<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Employer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Province, Employer};

class EditController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Employer $employer Employer
     * 
     * @return View
     */
    public function __invoke(Employer $employer): View
    {
        $this->authorize('update', $employer);        

        $provinces = Province::allRows();

        return view(
            'user.employer.edit',
            [
                'employer' => $employer,
                'provinces' => $provinces,
            ]
        );
    }
}
