<?php

namespace App\Http\Controllers\User\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Worker;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Worker $worker)  // Request $request
    {
        // $worker->lastname = $request->input('lastname');
        // $saved = $worker->save();
        $saved = false;

        $worker->fill($request->all());  // Worker class
        if ($worker->isDirty()) {
            $saved = $worker->save();  // bool

            /*
            $saved .= ' worker saved ';
            $saved .= $s;
            */
        }

        $worker->user->name = $request->input('name');
        if ($worker->user->isDirty()) {
            $saved = $worker->user->save();
            /*
            $saved .= ' user saved ';
            $saved .= $s;
            */
        }

        if ($saved) {
            $status = 'success';
            $message = "Zmieniono";
        } else {
            $status = 'info';
            $message = "Nie zmieniono";
        }

        return redirect()
            ->route('workers.show', $worker->id)
            ->with($status, $message);
    }
}
