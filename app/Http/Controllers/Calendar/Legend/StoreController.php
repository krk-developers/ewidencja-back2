<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Calendar\Legend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreLegend;
use App\Legend;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param StoreLegend $request Validation
     * 
     * @return RedirectResponse
     */
    public function __invoke(StoreLegend $request): RedirectResponse
    {
        $validated = $request->validated();

        Legend::create_($request->all());
        
        return redirect()
            ->route('legends.index')
            ->with('success', 'Dodano');
    }
}
