<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Admin;

class StoreController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request Request
     * @param Admin   $admin   Admin
     * 
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Admin $admin): RedirectResponse
    {
        $result = $admin::addEmployer(
            (int) $admin->id, (int) $request['employer_id']
        );
        
        return redirect()
            ->route('admins.employers.index', $admin->id)
            ->with($result['status'], $result['message']);
    }
}
