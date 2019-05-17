<?php

namespace App\Http\Controllers\User\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateWorker;
use App\Worker;
use Illuminate\Validation\Rule;
use Validator;

class UpdateController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWorker $request Validation
     * @param Worker       $worker  Worker
     * 
     * @return RedirectResponse
     */
    public function __invoke(UpdateWorker $request, Worker $worker): RedirectResponse
    {
        Validator::make(
            $request->all(),
            [
                'pesel' => [Rule::unique('workers')->ignore($worker->id)]
            ]
        );
        
        $validated = $request->validated();

        $saved = false;
        
        $worker->fill($validated);
        if ($worker->isDirty()) {
            $saved = $worker->saveRecord();
        }

        $worker->user->name = $request->input('name');
        if ($worker->user->isDirty()) {
            $saved = $worker->user->saveRow();            
        }

        $status = 'info';
        $message = "Nie zmieniono";

        if ($saved) {
            $status = 'success';
            $message = "Zmieniono";
        }
        
        return redirect()
            ->route('workers.show', $worker->id)
            ->with($status, $message);
    }
}
