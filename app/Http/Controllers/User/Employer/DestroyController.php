<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employer;

class DestroyController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Employer $employer)
    {
        //
    }
}
