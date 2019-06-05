<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
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
     * @return View|RedirectResponse
     */
    public function __invoke(
        Request $request,
        Worker $worker,
        Employer $employer
    ): object {
        $this->authorize('removeEmployer', Worker::class);

        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            $worker->removeEmployer($employer->id);  // int
    
            return redirect()
                ->route('workers.show', $worker->id)
                ->with('success', 'Usunięto');
        }
    
        if ($delete == 'No') {
            return redirect()->route('workers.show', $worker->id);
        }
    
        return view(
            'user.worker.employer.destroy',
            [
                'worker' => $worker,
                'employer' => $employer
            ]
        );
    }
}
