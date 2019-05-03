<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Legend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Legend;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request Request
     * @param Legend  $legend  Legend
     * 
     * @return RedirectResponse
     */
    public function __invoke(Request $request, Legend $legend): RedirectResponse
    {
        $saved = false;

        $legend->fill($request->all());

        if ($legend->isDirty()) {
            $saved = $legend->save();  // bool
        }

        if ($saved) {
            $status = 'success';
            $message = "Zmieniono";
        } else {
            $status = 'info';
            $message = "Nie zmieniono";
        }

        return redirect()
            ->route('legends.show', $legend->id)
            ->with($status, $message);
    }
}
