<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Worker;

class StoreController extends Controller
{
    /**
     * Store information about employment for worker.
     *
     * @param Request $request Request
     * @param Worker  $worker  Worker
     * 
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Worker $worker): RedirectResponse
    {
        $result = $worker->addEmployer($request->all());
        
        $admin = $request->input('admin');
        $employer = $request->input('employer');

        if ($admin) {
            return redirect()
                ->route(
                    'admins.employers.workers.show',
                    [$admin, $employer, $worker]
                )
                ->with($result['status'], $result['message']);
        }

        return redirect()
            ->route('workers.show', $worker->id)
            ->with($result['status'], $result['message']);
    }
}
