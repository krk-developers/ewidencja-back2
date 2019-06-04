<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateAdmin;
use App\Admin;

class UpdateController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAdmin $request Validation
     * @param Admin       $admin   Admin
     * 
     * @return RedirectResponse
     */
    public function __invoke(UpdateAdmin $request, Admin $admin)
    {
        $validated = $request->validated();
        
        $saved = false;

        $admin->fill($request->all());  // Admin class
        if ($admin->isDirty()) {
            $saved = $admin->save();  // bool
        }

        $admin->user->name = $request->input('name');
        if ($admin->user->isDirty()) {
            $saved = $admin->user->save();
        }

        $status = 'info';
        $message = "Nie zmieniono";
        
        if ($saved) {
            $status = 'success';
            $message = "Zmieniono";
        }

        return redirect()
            ->route('admins.show', $admin->id)
            ->with($status, $message);
    }
}
