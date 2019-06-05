<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Worker;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\{User, Worker};

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View|RedirectResponse
     */
    public function __invoke(): object
    {
        // workers can only see their profile
        if (Auth::user()->type->name == 'worker') {
            return redirect()->route('workers.show', Auth::user()->userable->id);
        }

        $this->authorize('list', Worker::class);

        $workers = Worker::allSortBy();

        return view(
            'user.worker.index',
            ['workers' => $workers]
        );
    }
}
