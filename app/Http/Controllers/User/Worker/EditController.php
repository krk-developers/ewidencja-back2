<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Worker;

class EditController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Worker $worker Worker
     * 
     * @return View
     */
    public function __invoke(Worker $worker): View
    {
        $this->authorize('update', $worker);

        return view(
            'user.worker.edit',
            ['worker' => $worker]
        );
    }
}
