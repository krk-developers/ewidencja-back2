<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\SuperAdmin;

// use Illuminate\Http\Request;
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
        $superadmins = SuperAdmin::all_();

        return view(
            'user.superadmin.index',
            ['superadmins' => $superadmins]
        );
    }
}
