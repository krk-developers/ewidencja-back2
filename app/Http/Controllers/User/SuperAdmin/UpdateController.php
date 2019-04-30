<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\SuperAdmin;

class UpdateController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param Request    $request    Request
     * @param SuperAdmin $superadmin SuperAdmin
     * 
     * @return RedirectResponse
     */
    public function __invoke(
        Request $request,
        SuperAdmin $superadmin
    ): RedirectResponse {
        $saved = false;

        $superadmin->fill($request->all());  // SuperAdmin class
        if ($superadmin->isDirty()) {
            $saved = $superadmin->save();  // bool
        }

        $superadmin->user->name = $request->input('name');
        if ($superadmin->user->isDirty()) {
            $saved = $superadmin->user->save();
        }

        if ($saved) {
            $status = 'success';
            $message = "Zmieniono";
        } else {
            $status = 'info';
            $message = "Nie zmieniono";
        }

        return redirect()
            ->route('superadmins.show', $superadmin->id)
            ->with($status, $message);
    }
}
