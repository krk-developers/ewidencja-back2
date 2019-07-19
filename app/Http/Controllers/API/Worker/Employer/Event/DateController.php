<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API\Worker\Employer\Event;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\WorkerEmployerEvent as EventResource;
use App\{Worker, Employer, Days};

class DateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
        Worker $worker,
        Employer $employer,
        string $date
    )/*: JsonResponse*/ {
        // return response()->json(['function' => __FUNCTION__]);
        /*
        return response()->json(
            [
                'worker' => $worker->id,
                'employer' => $employer->id,
                'date' => $date
            ]
        );
        */

        $start = Days::start($date);
        $end = $start->endOfMonth();

        $startAsString = $start->toDateString();
        $endAsString = $end->toDateString();

        return new EventResource(
            $worker->eventsByEmployerID1(
                $employer->id,
                $startAsString,
                $endAsString
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
