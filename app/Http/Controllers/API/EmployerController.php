<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Http\JsonResponse;
use App\{Employer, Worker};
use App\Http\Resources\Employer as EmployerResource;

class EmployerController extends Controller
{
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
    public function store(Request $request)
    {
        //
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
