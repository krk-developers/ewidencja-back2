<?php

namespace App\Http\Controllers\User\Admin\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Admin, Employer, Province};

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Admin $admin, Employer $employer)
    {
        //return __CLASS__;
        //return $request;
        //$this->authorize('update', $employer);        

        $provinces = Province::allRows();

        return view(
            'user.admin.employer.edit',
            [
                'admin' => $admin,
                'employer' => $employer,
                'provinces' => $provinces,
            ]
        );
    }
}
