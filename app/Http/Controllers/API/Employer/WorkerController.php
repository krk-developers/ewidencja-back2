<?php

namespace App\Http\Controllers\API\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Employer, Worker};

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $employer = Employer::findRow($request['employer_id']);

        $result = $employer->addWorker($request->all());
        // dd($result);
        if ($result['status'] != 'success') {
            return response()->json(
                ['created' => false, 'message' => $result['message']]
            );
        }

        return response()->json(['created' => true], 201);
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
    public function destroy(Employer $employer, Worker $worker)
    {
        $deleted = $employer->removeWorker($worker->id);  // 0|1

        if ($deleted === 0) {
            return response()->json(['deleted' => false]);
        }
        
        return response()->json(['deleted' => true]);
    }
}
