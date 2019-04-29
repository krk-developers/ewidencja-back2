<?php

namespace App\Http\Controllers\User\Worker\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\{Worker, Employer};

class DestroyController extends Controller
{
    /**
     * Remove the employer.
     * The employee no longer works for him.
     *
     * @param Request  $request  Request
     * @param Worker   $worker   Worker
     * @param Employer $employer Employer
     * 
     * @return RedirectResponse
     */
    public function __invoke(
        Request $request,
        Worker $worker,
        Employer $employer
    ): RedirectResponse {
        $worker->removeEmployer($employer->id);  // int

        return redirect()
            ->route('workers.show', $worker->id)
            ->with('success', 'Usunięto');
    }
}
