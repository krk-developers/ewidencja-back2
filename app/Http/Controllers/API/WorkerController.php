<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Http\JsonResponse;
// use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\{Worker, User, Event, Type};
use App\Http\Resources\Worker as WorkerResource;
use App\Http\Resources\Event as EventResource;
use App\Http\Requests\StoreWorker;
use Illuminate\Validation\ValidationException;

class WorkerController extends Controller
{
    private const TYPE_MODEL_NAME = 'App\Worker';

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
     * @param Request $request Request
     * 
     * @return Response
     */
    public function store(StoreWorker $request)//: Response
    {
        $request->validated();

        $worker = Worker::createRow($request->all());

        if (! $worker) {
            return response()->json(['created' => false]);
        }

        $request['userable_id'] = $worker->id;
        $request['userable_type'] = self::TYPE_MODEL_NAME;
        $request['type_id'] = Type::findIDByModelName(self::TYPE_MODEL_NAME);

        $user = User::createRow($request->all());

        if (! $user) {
            return response()->json(['created' => false]);
        }

        return response()->json(['created' => true], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Worker $worker Worker.
     * 
     * @return EventResource
     */
    public function show(Worker $worker): EventResource
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
    public function destroy(Worker $worker)
    {
        $deleted = $worker->deleteRow();
        
        if (! $deleted) {
            return response()->json(['deleted' => false]);
        }

        return response()->json(['deleted' => true]);
    }
}
