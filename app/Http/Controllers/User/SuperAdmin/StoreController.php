<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\{Type, User, SuperAdmin};

class StoreController extends Controller
{
    private const TYPE_MODEL_NAME = 'App\SuperAdmin';

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request Request
     * 
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $request['type_id'] = Type::findIDByModelName(self::TYPE_MODEL_NAME);

        $superadmin = SuperAdmin::create_($request->all());

        $request['userable_id'] = $superadmin->id;
        $request['userable_type'] = self::TYPE_MODEL_NAME;

        $user = User::create_($request->all());

        return redirect()->route('superadmins.index')->with('success', 'Dodano');
    }
}
