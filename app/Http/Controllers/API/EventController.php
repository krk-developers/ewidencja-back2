<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

// use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Event;
use App\Http\Resources\Event as EventResource;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return EventResource
     */
    public function index(): EventResource
    {
        // return response()->json(['function' => __FUNCTION__]);
        
        return new EventResource(Event::all_());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        // return response()->json($request, 201);
        
        $created = Event::createRow($request->all());

        if (! $created) {
            return response()->json(['created' => false]);
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
     * @param int $id ID
     * 
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = Event::destroyRow($id);
        
        if (! $deleted) {
            return response()->json(['deleted' => false]);
        }

        return response()->json(['deleted' => true]); 
    }
}
