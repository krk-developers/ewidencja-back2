<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Legend;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Legend;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return View
     */
    public function __invoke(): View  // Request $request
    {
        $legends = Legend::all_();
        // return $all;
        return view(
            'calendar.legend.index',
            ['legends' => $legends]
        );
    }
}
