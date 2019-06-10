<?php

namespace App\Http\Controllers\User\Admin\Employer\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Admin, Employer, Worker};

class DestroyController extends Controller
{
    /**
     * Remove worker from list.
     *
     * @param Request  $request  Request
     * @param Admin    $admin    Admin
     * @param Employer $employer Employer
     * @param Worker   $worker   Worker
     * 
     * @return View|RedirectResponse
     */
    public function __invoke(
        Request $request,
        Admin $admin,
        Employer $employer,
        Worker $worker
    ): object {
        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            // $worker->deleteRow();
            $employer->removeWorker($worker->id);

            return redirect()
                ->route('admins.employers.show', [$admin, $employer])
                ->with('success', 'Usunięto');
            
        }

        if ($delete == 'No') {
            return redirect()->route(
                'admins.employers.workers.show', [$admin, $employer, $worker]
            );
        }

        return view(
            'user.admin.employer.worker.destroy',
            [
                'admin' => $admin,
                'employer' => $employer,
                'worker' => $worker]
        );
    }
}
