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
        $employer->removeWorker($worker->id);  // int

        return redirect()
            ->route('employers.show', $employer->id)
            ->with('success', 'Usunięto');
    }
}
