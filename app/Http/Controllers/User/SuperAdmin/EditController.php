<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\SuperAdmin;

class EditController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param SuperAdmin $superadmin SuperAdmin
     * 
     * @return View
     */
    public function __invoke(SuperAdmin $superadmin): View
    {
        $this->authorize('update', $superadmin);

        return view(
            'user.superadmin.edit',
            ['superadmin' => $superadmin]
        );
    }
}
