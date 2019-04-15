<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Http\JsonResponse;
// use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\{Worker, Event};
use App\Http\Resources\Worker as WorkerResource;
use App\Http\Resources\Event as EventResource;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return WorkerResource
     */
    public function index(): WorkerResource
    {
        // return response()->json(['function' => __FUNCTION__]);
        return new WorkerResource(Worker::all_());
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
    public function show(Worker $worker)
    {
        // return $worker;
        // return response()->json(['function' => $worker->events]);
        // return response()->json(['function' => __FUNCTION__ . $worker->id]);
        return new EventResource(Event::byWorkerID($worker->id));
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
