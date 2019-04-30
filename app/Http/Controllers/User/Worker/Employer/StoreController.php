<?php

namespace App\Http\Controllers\User\Worker\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Worker;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Worker $worker)
    {
        $id = (int) $request->input('employer_id');

        $result = $worker->addEmployer($id);
        // dd($success['message']);
        return redirect()
            ->route('workers.show', $worker->id)
            ->with($result['status'], $result['message']);
    }
}
