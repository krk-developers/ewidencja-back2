<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreWorker;
use App\{Type, User, Worker};

class StoreController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWorker $request Validation
     * 
     * @return RedirectResponse
     */
    public function __invoke(StoreWorker $request): RedirectResponse
    {
        $request->validated();
     
        $typeModelName = 'App\Worker';
        $request['type_id'] = Type::findIDByModelName($typeModelName);

        $worker = Worker::createRow($request->all());

        $request['userable_id'] = $worker->id;
        $request['userable_type'] = $typeModelName;

        User::createRow($request->all());
        
        return redirect()->route('workers.index')->with('success', 'Dodano');
    }
}
