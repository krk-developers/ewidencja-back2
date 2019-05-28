<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Province;
use App\Http\Resources\Province as ProvinceResource;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProvinceResource
     */
    public function index(): ProvinceResource
    {
        // return response()->json(['function' => __FUNCTION__]);
        return new ProvinceResource(Province::allRows());
    }
}
