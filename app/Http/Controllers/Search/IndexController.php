<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Search;

class IndexController extends Controller
{
    /*
    public function index()
    {
        return __CLASS__;
    }
    */

    /**
     * Search workers and employers
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
        $workers = $search->workers($searchString);
        $employers = $search->employers($searchString);
        
        return view(
            'search.index',
            [
                'workers' => $workers,
                'employers' => $employers
            ]
        );
    }
}
