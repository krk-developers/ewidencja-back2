<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class WelcomeController extends Controller
{
    /**
     * Show the welcome page.
     *
     * @param Request $request Request
     * 
     * @return View|RedirectResponse
     */
    public function index(Request $request): object
    {
        /*
        $rectok = $request->cookie('rectok');
        $usertype = $request->cookie('usertype');
        */
        /*
        // if cookie exist, redirect to frontend
        if ($rectok) {
            return redirect(config('record.frontend_page'))
                ->header('API-Token', $rectok)
                ->header('User-Type', $usertype)
                ->cookie($rectok)
                ->cookie($usertype);
        }
        */

        // from where user came
        session(['previous' => route('welcome')]);

        return redirect()->route('login');
    }

    /**
     * Show logout page
     *
     * @return View
     */
    public function logout(): View
    {
        return view('welcome');
    }
}
