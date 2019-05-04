<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\PublicHoliday;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Event;
use Carbon\Carbon;

class IndexController extends Controller
{
    /**
     * Display a listing of the public holidays.
     *
     * @return View
     */
    public function __invoke(): View
    {
        $nextYear = Carbon::now()->addYear()->year;
        $previousYear = Carbon::now()->subYear()->year;

        $publicHolidays = Event::publicHolidays(Carbon::now()->year);
        $nearestPublicHolidays = Event::nearestPublicHolidays(Carbon::now()->year);

        return view(
            'calendar.public_holiday.index',
            [
                'nearest_public_holiday' => $nearestPublicHolidays,
                'public_holidays' => $publicHolidays,
                'nextYear' => $nextYear,
                'previousYear' => $previousYear,
            ]
        );
    }
}
