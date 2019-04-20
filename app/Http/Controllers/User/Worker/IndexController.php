<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\User;

class IndexController extends Controller
{
    public function __construct()
    {
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function __invoke()//: View  // Request $request
    {
        // workers can only see their profile
        if (Auth::user()->type->name == 'worker') {
            return redirect()->route('workers.show', Auth::user()->userable->id);
        }
        
        $users = User::byType('worker');
        // return dd($users[0]->userable_id);
        return view(
            'user.worker.index',
            ['users' => $users]
        );
    }
}
