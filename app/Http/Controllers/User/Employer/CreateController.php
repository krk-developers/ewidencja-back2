<?php

namespace App\Http\Controllers\User\Employer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Province;
use App\Employer;

class CreateController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function __invoke(): View
    {
        $this->authorize('create', Employer::class);

        $provinces = Province::allRows();
        
        return view('user.employer.create', ['provinces' => $provinces]);
    }
}
