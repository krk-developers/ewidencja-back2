<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Employer\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\{Employer, Worker};

class FiredController extends Controller
{
    /**
     * Fired form and operation.
     *
     * @param Request  $request  Request
     * @param Employer $employer Employer
     * @param Worker   $worker   Worker
     * 
     * @return View|RedirectResponse
     */
    public function __invoke(
        Request $request,
        Employer $employer,
        Worker $worker
    ): object {
        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            $employer->removeWorker($worker->id);
            
            return redirect()
                ->route('employers.show', $employer->id)
                ->with('success', 'Usunięto');
        }

        if ($delete == 'No') {
            return redirect()->route('employers.show', $employer->id);
        }

        return view(
            'user.employer.worker.fired',
            [
                'employer' => $employer,
                'worker' => $worker
            ]
        );
    }
}
