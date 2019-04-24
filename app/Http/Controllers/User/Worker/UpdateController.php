<?php

namespace App\Http\Controllers\User\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Worker;

class UpdateController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request Request
     * @param Worker  $worker  Worker
     * 
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Worker $worker): RedirectResponse
    {
        $saved = false;

        $worker->fill($request->all());  // Worker class
        if ($worker->isDirty()) {
            $saved = $worker->save();  // bool
        }

        $worker->user->name = $request->input('name');
        if ($worker->user->isDirty()) {
            $saved = $worker->user->save();
        }

        if ($saved) {
            $status = 'success';
            $message = "Zmieniono";
        } else {
            $status = 'info';
            $message = "Nie zmieniono";
        }

        return redirect()
            ->route('workers.show', $worker->id)
            ->with($status, $message);
    }
}
