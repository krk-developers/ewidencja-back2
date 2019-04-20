<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\PublicHoliday;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Event;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return View
     */
    public function __invoke()//: View  // Request $request
    {
        $publicHolidays = Event::publicHolidays();
        $nearestPublicHolidays = Event::nearestPublicHolidays();
        // return $publicHolidays;
        return view(
            'calendar.public_holiday.index',
            [
                'nearest_public_holiday' => $nearestPublicHolidays,
                'public_holidays' => $publicHolidays
            ]
        );
    }
}
