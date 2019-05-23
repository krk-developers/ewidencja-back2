<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\SuperAdmin;

class DestroyController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Request    $request    Request
     * @param SuperAdmin $superadmin SuperAdmin
     * 
     * @return View|RedirectResponse
     */
    public function __invoke(Request $request, SuperAdmin $superadmin): object
    {
        $this->authorize('delete', $superadmin);

        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            $superadmin->deleteRow();
            
            return redirect()
                ->route('superadmins.index')
                ->with('success', 'Usunięto');
            
        }

        if ($delete == 'No') {
            return redirect()->route('superadmins.show', $superadmin->id);
        }

        return view(
            'user.superadmin.destroy',
            ['superadmin' => $superadmin]
        );
    }
}
