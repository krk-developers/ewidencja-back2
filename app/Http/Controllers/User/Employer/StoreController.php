<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employer;
use App\Http\Requests\StoreEmployer;

class StoreController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreEmployer $request)
    {
        //
    }
}
