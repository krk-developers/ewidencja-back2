<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreWorker;
use App\{Type, User, Worker};
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private const TYPE_MODEL_NAME = 'App\Worker';

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWorker $request Validation
     * 
     * @return RedirectResponse
     */
    public function __invoke(StoreWorker $request): RedirectResponse
    {
        // return $request;
        /*
        if ($request['equivalent'] == 0) {
            $request['equivalent_amount'] = 0;
        }
        */
        $request->validated();
        
        $request['type_id'] = Type::findIDByModelName(self::TYPE_MODEL_NAME);

        $worker = Worker::createRow($request->all());

        $request['userable_id'] = $worker->id;
        $request['userable_type'] = self::TYPE_MODEL_NAME;

        User::createRow($request->all());
        
        return redirect()->route('workers.index')->with('success', 'Dodano');
    }
}
