<?php

namespace App\Http\Controllers\User\Employer\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employer;
use App\Http\Requests\StoreEmployerWorker;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreEmployerWorker $request, Employer $employer)
    {
        // return $request;
        $validated = $request->validated();

        $id = (int) $request->input('worker_id');

        $result = $employer->addWorker($id);
        // dd($result);
        return redirect()
            ->route('employers.show', $employer->id)
            ->with($result['status'], $result['message']);
    }
}
