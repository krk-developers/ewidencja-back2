<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Admin;

class EditController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Admin $admin Admin
     * 
     * @return View
     */
    public function __invoke(Admin $admin): View
    {
        $this->authorize('update', $admin);
        
        return view(
            'user.admin.edit',
            ['admin' => $admin]
        );
    }
}
