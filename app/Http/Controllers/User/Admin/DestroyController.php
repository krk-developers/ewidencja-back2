<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Admin;

class DestroyController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request Request
     * @param Admin   $admin   Admin
     * 
     * @return View|RedirectResponse
     */
    public function __invoke(Request $request, Admin $admin): object
    {
        $this->authorize('delete', $admin);

        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            $admin->deleteRow();
            return redirect()
                ->route('admins.index')
                ->with('success', 'Usunięto');
            
        }

        if ($delete == 'No') {
            return redirect()->route('admins.show', $admin->id);
        }

        return view(
            'user.admin.destroy',
            ['admin' => $admin]
        );
    }
}
