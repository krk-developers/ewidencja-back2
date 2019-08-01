<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Search;

class IndexController extends Controller
{
    /**
     * Search workers, employers and legend
     *
     * @param Request $request Request
     * 
     * @return View
     */
    public function search(Request $request): View
    {
        $searchString = $request->query('co');

        if ($searchString == null) {
            return back();
        }

        $search = new Search();
        $workers = $search->workers(
            $searchString,
            Auth::user()->type->name,
            Auth::user()->userable_id
        );
        $employers = $search->employers(
            $searchString,
            Auth::user()->type->name,
            Auth::user()->userable_id
        );
        $legends = $search->legend($searchString);
        
        return view(
            'search.index',
            [
                'workers' => $workers,
                'employers' => $employers,
                'legends' => $legends
            ]
        );
    }
}
