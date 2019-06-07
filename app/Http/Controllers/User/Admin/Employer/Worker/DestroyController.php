<?php

namespace App\Http\Controllers\User\Admin\Employer\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Admin, Employer, Worker};

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Admin $admin, Employer $employer, Worker $worker)
    {
        // return $request;
        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            $worker->deleteRow();

            return redirect()
                ->route('admins.employers.workers.index')
                ->with('success', 'Usunięto');
            
        }

        if ($delete == 'No') {
            return redirect()->route(
                'admins.employers.workers.show',
                [$admin->id, $employer->id, $worker->id]
            );
        }

        return view(
            'admin.employer.worker.destroy',
            ['worker' => $worker]
        );
    }
}
