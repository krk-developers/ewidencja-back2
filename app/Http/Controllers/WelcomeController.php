<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\UrlGenerator;

class WelcomeController extends Controller
{

    /**
     * Show the welcome page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)//: Response
    {
        // $value = request()->cookie();  // $request->cookie('rectok');
        $rectok = $request->cookie('rectok');
        $usertype = $request->cookie('usertype');

        // if cookie exist, redirect to frontend
        if ($rectok) {
            return redirect(config('record.frontend_page'))
                ->header('API-Token', $rectok)
                ->header('User-Type', $usertype)
                ->cookie($rectok)
                ->cookie($usertype);
        }
        
        // from where user came
        session(['previous' => route('welcome')]);

        return redirect()->route('login');

        // return view('welcome');
    }

    public function logout()
    {
        return view('welcome');
    }
}
