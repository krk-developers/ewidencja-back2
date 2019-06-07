<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Admin, Employer};

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Admin $admin, Employer $employer)
    {
        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            
            $admin->removeEmployer((int) $admin->id, (int) $employer->id);

            return redirect()
                ->route(
                    'admins.employers.index',
                    [$admin->id, $employer->id]
                )
                ->with('success', 'Usunięto');
            
        }

        if ($delete == 'No') {
            return redirect()->route(
                'admins.employers.show',
                [$admin->id, $employer->id]
            );
        }

        return view(
            'user.admin.employer.destroy',
            [
                'admin' => $admin,
                'employer' => $employer,
            ]
        );
    }
}
