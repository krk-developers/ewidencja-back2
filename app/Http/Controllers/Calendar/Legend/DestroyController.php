<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Legend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Legend;

class DestroyController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request Request
     * @param Legend  $legend  Legend
     * 
     * @return View|RedirectResponse
     */
    public function __invoke(Request $request, Legend $legend): object
    {
        $this->authorize('delete', $legend);

        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            $legend->destroy_($legend->id);

            return redirect()
                ->route('legends.index')
                ->with('success', 'Usunięto');
            
        }

        if ($delete == 'No') {
            return redirect()
                ->route('legends.show', $legend->id)
                ->with('info', 'Nie usunięto');
        }

        return view('calendar.legend.destroy', ['legend' => $legend]);
    }
}
