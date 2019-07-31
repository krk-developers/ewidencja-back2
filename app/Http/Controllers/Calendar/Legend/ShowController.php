<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Legend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Legend;

class ShowController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Legend $legend Legend
     * 
     * @return View
     */
    public function __invoke(Legend $legend): View
    {
        $this->authorize('view', $legend);

        return view(
            'calendar.legend.show',
            ['legend' => $legend]
        );
    }
}
