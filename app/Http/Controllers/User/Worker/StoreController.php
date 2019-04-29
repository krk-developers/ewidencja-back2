<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\{Type, User, Worker};
use App\Http\Requests\StoreWorker;

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
        $validated = $request->validated();

        $request['type_id'] = Type::findIDByModelName(self::TYPE_MODEL_NAME);

        $worker = Worker::create_($request->all());

        $request['userable_id'] = $worker->id;
        $request['userable_type'] = self::TYPE_MODEL_NAME;

        $user = User::create_($request->all());

        return redirect()->route('workers.index')->with('success', 'Dodano');
    }
}
