<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Legend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Legend;

class EditController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Legend $legend Legend
     * 
     * @return View
     */
    public function __invoke(Legend $legend): View
    {
        return view('calendar.legend.edit', ['legend' => $legend]);
    }
}
