<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
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
    public function index()
    {
        // return view('home');
        // $user = Auth::user();
        
        $userID = Auth::id();
        $user = Auth::user();
        $apiToken = User::apiToken($userID);
        $minutes = 60;
        
        return response()
            ->view('home', ['user' => $user])
            ->header('API-Token', $apiToken)
            ->cookie('rectok', $apiToken, $minutes);
    }
}
