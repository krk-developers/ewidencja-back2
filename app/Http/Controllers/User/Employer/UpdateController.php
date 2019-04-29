<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employer;
use App\Http\Requests\StoreEmployer;

class UpdateController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreEmployer $request, Employer $employer)
    {
        // return $employer;
        $saved = false;

        $employer->fill($request->all());
        // dd($employer->isDirty());
        
        if ($employer->isDirty()) {
            $saved = $employer->save();
        }

        $employer->user->name = $request->input('name');
        // dd($employer->user->isDirty());
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
