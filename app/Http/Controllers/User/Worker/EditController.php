<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Worker;

class EditController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Worker $worker Worker
     * 
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Worker $worker)  // Request $request
    {
        // return $worker;
        return view(
            'user.worker.edit',
            ['worker' => $worker]
        );
    }
}
