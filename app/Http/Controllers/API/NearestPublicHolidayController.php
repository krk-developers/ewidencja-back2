<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Http\Resources\Event as EventResource;

class NearestPublicHolidayController extends Controller
{
    /**
     * Display a nearest public holiday.
     *
     * @return EventResource
     */
    public function __invoke(): EventResource
    {
        // return response()->json(['function' => __FUNCTION__]);
        return new EventResource(Event::nearestPublicHolidays());
    }
}
