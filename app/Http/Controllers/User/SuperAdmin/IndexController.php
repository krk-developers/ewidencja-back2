<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\SuperAdmin;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function __invoke(): View
    {
        $this->authorize('list', SuperAdmin::class);

        $superadmins = SuperAdmin::allSortBy();

        return view(
            'user.superadmin.index',
            ['superadmins' => $superadmins]
        );
    }
}
