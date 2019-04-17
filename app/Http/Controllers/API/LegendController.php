<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Legend;
use App\Http\Resources\Legend as LegendResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LegendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): AnonymousResourceCollection
    {
        // return response()->json(['function' => __FUNCTION__]);
        return LegendResource::collection(Legend::all_());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request Request
     * 
     * @return Response
     */
    public function store(Request $request): JsonResponse
    {
        // return response()->json($request, 201);

        $created = Legend::create_($request->all());

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = Legend::destroy_($id);
        
        if (! $deleted) {
            return response()->json(['deleted' => false]);
        }

        return response()->json(['deleted' => true]);        
    }
}
