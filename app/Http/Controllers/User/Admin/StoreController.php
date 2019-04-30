<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\{Type, User, Admin};

class StoreController extends Controller
{
    private const TYPE_MODEL_NAME = 'App\Admin';

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request Request
     * 
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        // return $request;
        $request['type_id'] = Type::findIDByModelName(self::TYPE_MODEL_NAME);

        $admin = Admin::create_($request->all());

        $request['userable_id'] = $admin->id;
        $request['userable_type'] = self::TYPE_MODEL_NAME;

        $user = User::create_($request->all());

        return redirect()->route('admins.index')->with('success', 'Dodano');
    }
}
