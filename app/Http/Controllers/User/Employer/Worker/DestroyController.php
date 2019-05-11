<?php

namespace App\Http\Controllers\User\Employer\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Employer, Worker};

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Employer $employer, Worker $worker)
    {
        // return __CLASS__;
        /*
        $employer->removeWorker($worker->id);  // int

        return redirect()
            ->route('employers.show', $employer->id)
            ->with('success', 'Usunięto');
        */

        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            $employer->removeWorker($worker->id);  // int

            return redirect()
                ->route('employers.show', $employer->id)
                ->with('success', 'Usunięto');
        }

        if ($delete == 'No') {
            return redirect()->route('employers.show', $employer->id);
        }

        return view(
            'user.employer.worker.destroy',
            [
                'employer' => $employer,
                'worker' => $worker
            ]
        );
    }
}
