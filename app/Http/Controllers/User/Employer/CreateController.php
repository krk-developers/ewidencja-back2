<?php

namespace App\Http\Controllers\User\Employer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Province;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function __invoke(): View
    {
        // $this->authorize('create');

        $provinces = Province::allRows();
        
        return view('user.employer.create', ['provinces' => $provinces]);
    }
}
