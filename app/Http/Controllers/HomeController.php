<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\User;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): Response
    {
        // $id = Auth::id();
        $user = Auth::user();
        // $user = User::find_($id);
        $apiToken = $user->api_token;  // User::apiToken($userID);
        $minutes = 60;

        $userType = $user->type->name;
        
        return response()
            ->view('home')
            ->header('API-Token', $apiToken)
            ->header('User-Type', $userType)
            ->cookie('rectok', $apiToken, $minutes)
            ->cookie('usertype', $userType, $minutes);
    }
}
