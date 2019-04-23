<?php

namespace App\Http\Controllers\User\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Worker;

class ShowController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Worker $worker Worker
     * 
     * @return View
     */
    public function __invoke(Worker $worker)  // Request $request
    {
        $this->authorize('view', $worker);
        // $users = User::byType('worker');
        // return dd($users[0]->userable_id);
        return view(
            'user.worker.show',
            ['worker' => $worker]
        );        
        // return $worker->user;
    }
    
    /*
    public function index(Worker $worker)
    {}
    */
}
