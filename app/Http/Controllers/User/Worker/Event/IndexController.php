<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Worker;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Worker $worker Worker
     * 
     * @return View
     */
    public function __invoke(Worker $worker)//: View
    {
        // return $worker->employers;//->wherePivot('worker_id', 1);
        return view(
            'user.worker.event.index', ['worker' => $worker]
        );
    }
}
