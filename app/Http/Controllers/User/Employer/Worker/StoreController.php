<?php

namespace App\Http\Controllers\User\Employer\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employer;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Employer $employer)
    {
        // return $request;
        $id = (int) $request->input('worker_id');

        $employer->addWorker($id);

        return redirect()
            ->route('employers.show', $employer->id)
            ->with('success', 'Dodano');
    }
}
