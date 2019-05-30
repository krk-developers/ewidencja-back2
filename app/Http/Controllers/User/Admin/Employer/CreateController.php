<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin\Employer;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Admin, Employer};

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Admin $admin)  // Request $request
    {
        // return $admin;
        // return __CLASS__;
        $employers = Employer::allSortBy();

        return view(
            'user.admin.employer.create',
            [
                'admin' => $admin,
                'employers' => $employers,
            ]
        );
    }
}
