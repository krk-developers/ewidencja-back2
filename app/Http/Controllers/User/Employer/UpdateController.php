<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Employer;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Employer;
use App\Http\Requests\UpdateEmployer;

class UpdateController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param StoreEmployer $request  Validator
     * @param Employer      $employer Employer
     * 
     * @return RedirectResponse
     */
    public function __invoke(
        UpdateEmployer $request,
        Employer $employer
    ): RedirectResponse {
        $saved = false;

        $employer->fill($request->all());
        
        if ($employer->isDirty()) {
            $saved = $employer->save();
        }

        $employer->user->name = $request->input('name');

        if ($employer->user->isDirty()) {
            $saved = $employer->user->save();
        }

        if ($saved) {
            $status = 'success';
            $message = "Zmieniono";
        } else {
            $status = 'info';
            $message = "Nie zmieniono";
        }

        return redirect()
            ->route('employers.show', $employer->id)
            ->with($status, $message);
    }
}
