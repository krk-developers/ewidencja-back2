<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Type, User, Worker};

class StoreController extends Controller
{
    private const TYPE_MODEL_NAME = 'App\Worker';

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // const TYPE_MODEL_NAME = 'App\Worker';        

        $request['type_id'] = Type::findIDByModelName(self::TYPE_MODEL_NAME);

        // return $request;

        $worker = Worker::create_($request->all());
        // dd($worker->id);
        // $userable_id = $worker->id;
        $request['userable_id'] = $worker->id;
        $request['userable_type'] = self::TYPE_MODEL_NAME;
        $user = User::create_($request->all());

        return redirect()->route('workers.index')->with('success', 'Dodano');

        // return $user;
    }
}
