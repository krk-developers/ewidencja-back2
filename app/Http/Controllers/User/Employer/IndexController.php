<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Employer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Employer;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View|RedirectResponse
     */
    public function __invoke(): object
    {
        // dd(Auth::user()->userable_type);
        // $this->authorize('view', Auth::user()->userable_type);
        // $this->authorize('view', Auth::user());
        // dd(Auth::user());  // ->type->name
        // employers can only see their profile
        /*
        if (Auth::user()->type->name == 'employer') {
            return redirect()->route('employers.show', Auth::user()->userable->id);
        }
        */
        $employers = Employer::allSortBy();

        return view(
            'user.employer.index',
            ['employers' => $employers]
        );
    }
}
