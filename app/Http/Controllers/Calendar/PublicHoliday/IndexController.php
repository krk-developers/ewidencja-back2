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
        $currentYear = Carbon::now()->year;
        $nextYear = Carbon::now()->addYear()->year;
        $previousYear = Carbon::now()->subYear()->year;

        $publicHolidays = Event::publicHolidays($currentYear);
        $nearestPublicHolidays = Event::nearestPublicHolidays($currentYear);
        
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
