<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API\Employer;

use App\Http\Controllers\Controller;
use App\{User, Employer, Worker, Type};
use App\Http\Resources\Employer as EmployerResource;
use App\Http\Requests\{StoreEmployer, UpdateEmployer};

class EmployerController extends Controller
{
    const TYPE_MODEL_NAME = 'App\Employer';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return response()->json(['function' => __FUNCTION__]);
        return new EmployerResource(Employer::all_());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployer $request)
    {
        // return response()->json(['function' => __FUNCTION__]);
        
        $request->validated();

        $request['type_id'] = Type::findIDByModelName(self::TYPE_MODEL_NAME);

        $employer = Employer::createRow($request->all());

        $request['userable_id'] = $employer->id;
        $request['userable_type'] = self::TYPE_MODEL_NAME;

        $user = User::createRow($request->all());

        if (! $user) {
            return response()->json(['created' => false]);
        }

        return response()->json(['created' => true], 201);
    }

    /**
     * Display the workers of employers
     *
     * @param Employer $employer Employer
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Employer $employer): EmployerResource
    {
        //return $employer;
        return new EmployerResource(Employer::workersByEmployerID($employer->id));
    }

    /**
     * All events of the worker who works fot the employer
     *
     * @param Employer $employer Employer
     * @param Worker   $worker   Worker
     * 
     * @return EmployerResource
     */
    public function event(Employer $employer, Worker $worker): EmployerResource
    {
        return new EmployerResource(
            Employer::eventsByEmployerAndWorkerID(
                $employer->id,
                $worker->id
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployer $request, int $employerID)
    {
        $request->validated();

        $employer = Employer::findRow($employerID);
        // dd($employer->user);
        $saved = false;

        $employer->fill($request->all());
        if ($employer->isDirty()) {
            $saved = $employer->saveRow();
        }

        $employer->user->name = $request['name'];
        if ($employer->user->isDirty()) {
            $saved = $employer->saveUserRow();  // ->user->save();
        }

        if ($saved === false) {
            return response()->json(['updated' => false]);
        }
        // dd($employer);
        return response()->json(['updated' => true]);
        // return response()->json(['updated' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $employerID Employer ID
     * 
     * @return Response
     */
    public function destroy(int $employerID)
    {
        $employer = Employer::findRow($employerID);
        
        $deleted = $employer->deleteRow();

        if (! $deleted) {
            return response()->json(['deleted' => false]);
        }

        return response()->json(['deleted' => true]); 
    }
}
