<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\SuperAdmin;

class EditController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SuperAdmin $superadmin): View  // Request $request, 
    {
        $this->authorize('update', $superadmin);

        return view(
            'user.superadmin.edit',
            ['superadmin' => $superadmin]
        );
    }
}
