<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\{Worker, Legend};

class CreateController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return View
     */
    public function __invoke()//: View  // Request $request
    {
        return view(
            'calendar.event.create', 
            [
                'legends' => Legend::all_(),
                'workers' => Worker::all__(),
            ]
        );
    }
}
