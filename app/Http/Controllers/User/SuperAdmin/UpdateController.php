<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateSuperAdmin;
use App\SuperAdmin;

class UpdateController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSuperAdmin $request    Validation
     * @param SuperAdmin       $superadmin SuperAdmin
     * 
     * @return RedirectResponse
     */
    public function __invoke(
        UpdateSuperAdmin $request,
        SuperAdmin $superadmin
    ): RedirectResponse {
        $request->validated();
        
        $saved = false;

        $superadmin->fill($request->all());  // SuperAdmin class
        if ($superadmin->isDirty()) {
            $saved = $superadmin->save();  // bool
        }

        $superadmin->user->name = $request->input('name');
        if ($superadmin->user->isDirty()) {
            $saved = $superadmin->user->save();
        }

        $status = 'info';
        $message = "Nie zmieniono";
        
        if ($saved) {
            $status = 'success';
            $message = "Zmieniono";
        }

        return redirect()
            ->route('superadmins.show', $superadmin->id)
            ->with($status, $message);
    }
}
