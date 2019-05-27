<?php

namespace App\Http\Controllers\User\Employer\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\{Employer, Worker};

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
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
        // return __CLASS__;

        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            // $worker->removeEmployer($employer->id);
            $employer->removeWorker($worker->id);
            /*
            return redirect()
                ->route('workers.show', $worker->id)
                ->with('success', 'Usunięto');
            */
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
