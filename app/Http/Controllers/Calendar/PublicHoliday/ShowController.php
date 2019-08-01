<?php

namespace App\Http\Controllers\Calendar\PublicHoliday;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Event;
use Carbon\Carbon;

class ShowController extends Controller
{
    /**
     * Display public holidays for the year
     *
     * @param int $year Year
     * 
     * @return View
     */
    public function __invoke(int $year): View
    {
        $currentYear = Carbon::now()->year;
        $nextYear = Carbon::now()->addYear()->year;
        $previousYear = Carbon::now()->subYear()->year;

        $publicHolidays = Event::publicHolidays($year);
        $nearestPublicHolidays = Event::nearestPublicHolidays($year);

        return view(
            'calendar.public_holiday.index',
            [
                'nearest_public_holiday' => $nearestPublicHolidays,
                'public_holidays' => $publicHolidays,
                'currentYear' => $currentYear,
                'nextYear' => $nextYear,
                'previousYear' => $previousYear,
            ]
        );
    }
}
