<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin\Employer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Admin, Employer};

/**
 * Adds the new employer to the administrator's list.
 */
class CreateController extends Controller
{
    /**
     * Show the new employer admin list add form.
     *
     * @param Admin $admin Admin
     * 
     * @return View
     */
    public function __invoke(Admin $admin): View
    {
        $employers = Employer::allSortBy();

        return view(
            'user.admin.employer.create',
            [
                'admin' => $admin,
                'employers' => $employers,
            ]
        );
    }
}
