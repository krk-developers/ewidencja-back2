<?php

namespace App\Http\Controllers\User\Employer\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Employer;

class StoreController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request  $request  Request
     * @param Employer $employer Employer
     * 
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Employer $employer): RedirectResponse
    {
        $id = (int) $request->input('worker_id');

        $result = $employer->addWorker($id);

        return redirect()
            ->route('employers.show', $employer->id)
            ->with($result['status'], $result['message']);
    }
}
