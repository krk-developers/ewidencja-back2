<?php

namespace App\Http\Controllers\User\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EditWorker;
use App\Worker;
use Illuminate\Validation\Rule;
use Validator;

class UpdateController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param EditWorker $request Validation
     * @param Worker     $worker  Worker
     * 
     * @return RedirectResponse
     */
    public function __invoke(EditWorker $request, Worker $worker): RedirectResponse
    {
        Validator::make(
            $request->all(),
            [
                'pesel' => [Rule::unique('workers')->ignore($worker->id)]
            ]
        );
        
        $validated = $request->validated();
        
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
