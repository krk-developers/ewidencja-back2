<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Legend;

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
    public function __invoke(): View
    {
        $legends = Legend::allSortBy();

        return view(
            'calendar.legend.index',
            [
                'legends' => $legends,
                'legend' => Legend::class
            ]
        );
    }
}
