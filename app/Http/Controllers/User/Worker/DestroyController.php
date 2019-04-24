<?php

namespace App\Http\Controllers\User\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Worker;

class DestroyController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request Request
     * @param Worker  $worker  Worker
     * 
     * @return View|RedirectResponse
     */
    public function __invoke(Request $request, Worker $worker): object  // View|RedirectResponse
    {
        $this->authorize('delete', $worker);

        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            // return 'delete';

            // remove a many-to-many relationship record
            // $d = $worker->employers()->detach();

            // remove user
            // $u = $worker->user->delete();

            // remove worker
            // $w = $worker->delete();

            $worker->delete_();

            return redirect()
                ->route('workers.index')
                ->with('success', 'Usunięto');
            
        }

        if ($delete == 'No') {
            return redirect()->route('workers.show', $worker->id);
        }

        return view(
            'user.worker.destroy',
            ['worker' => $worker]
        );

        // return $worker;
    }
}
