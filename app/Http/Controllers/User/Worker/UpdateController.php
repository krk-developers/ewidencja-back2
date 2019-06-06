<?php

namespace App\Http\Controllers\User\Worker;

// use Illuminate\Http\Request;
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
    public function __invoke(UpdateWorker $request, Worker $worker)//: RedirectResponse
    {
        $admin = $request->query('admin');
        $employer = $request->query('employer');
        // dd($admin);
        // return $request;
        Validator::make(
            $request->all(),
            [
                'pesel' => [Rule::unique('workers')->ignore($worker->id)]
            ]
        );
        
        $validated = $request->validated();
        /*
        if ($validated['equivalent'] == 0) {
            $validated['equivalent_amount'] = 0;
        }
        */
        // dd($validated);
        // dd($request->all());
        $saved = false;
        // dd($worker->isDirty());
        // dd($worker->user->isDirty());
        $worker->fill($validated);  // $request->all()
        if ($worker->isDirty()) {
            $saved = $worker->saveRow();
            // dd($saved);
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
        
        // admin edit
        if ($admin) {
            return redirect()
                ->route(
                    'admins.employers.workers.show',
                    [$admin, $employer, $worker]
                )
                ->with($status, $message);
        }

        // super admin edit
        return redirect()
            ->route('workers.show', $worker->id)
            ->with($status, $message);
    }
}
