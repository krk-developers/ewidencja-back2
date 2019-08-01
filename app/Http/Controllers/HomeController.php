<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request Request
     * 
     * @return View|RedirectResponse
     */
    public function index(Request $request): object
    {
        $user = Auth::user();
        $apiToken = $user->api_token;
        $userType = $user->type->name;
        
        $rectok = cookie(
            'rectok',
            $apiToken,
            config('record.cookie_expires_in_minutes'),            
            '/',
            '',            
            true,
            false
        );
        
        $usertype = cookie(
            'usertype',
            $userType,
            config('record.cookie_expires_in_minutes'),
            '/',
            '',
            true,
            false
        );
        
        // from where user came   
        $previous = session('previous');
        session()->forget('previous');

        /*
        if (\App::environment('local')) {
            if ($previous == config('record.local_main_page') || $previous == config('record.host_main_page')) {  // local main page
                return $this->redirectToFrontend(
                    $apiToken, $userType, $rectok, $usertype
                );
            }
        } */ /* else {
            if ($previous == config('record.host_main_page')) {  // host main page
                return $this->redirectToFrontend(
                    $apiToken, $userType, $rectok, $usertype
                );
            }
        }
        */

        return response()
            ->view('home', ['previous' => $previous])
            ->header('API-Token', $apiToken)
            ->header('User-Type', $userType)
            ->cookie($rectok)
            ->cookie($usertype);
    }

    /**
     * Redirect to frontend page
     *
     * @param string $apiToken Token to login to API
     * @param string $userType User authentification
     * @param string $rectok   API token cookie
     * @param string $usertype User authentification
     * 
     * @return RedirectResponse
     */
    /*
    private function redirectToFrontend(
        $apiToken,
        $userType,
        $rectok,
        $usertype
    ): RedirectResponse {
        return redirect(config('record.frontend_page'))
            ->header('API-Token', $apiToken)
            ->header('User-Type', $userType)
            ->cookie($rectok)
            ->cookie($usertype);
    }
    */
}
