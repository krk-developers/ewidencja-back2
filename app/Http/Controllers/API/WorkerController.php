<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Worker, User, Event, Type};
use App\Http\Resources\Worker as WorkerResource;
use App\Http\Resources\Event as EventResource;
use App\Http\Requests\{StoreWorker, UpdateWorker};
use Illuminate\Validation\Rule;
use Validator;

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
    public function update(UpdateWorker $request, int $id)  // $request
    {
        // dd($request);
        $worker = Worker::findRow($id);

        $validator = Validator::make(
            $request->all(),
            [
                'pesel' => [Rule::unique('workers')->ignore($worker->id)]
            ]
        );
        // dd($validator->fails());
        // dd($validator->errors());
        $message = 'updated';

        $validated = $request->validated();

        $saved = false;
        
        $worker->fill($validated);

        // TODO why is dirty?
        if ($worker->isDirty()) {
            $saved = $worker->saveRow();
        }

        $worker->user->name = $request['name'];
        if ($worker->user->isDirty()) {
            $saved = $worker->user->saveRow();            
        }

        return response()->json([$message => $saved], 200);
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

    public function addEmployer()
    {
    }
}
