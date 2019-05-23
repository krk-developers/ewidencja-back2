<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreSuperAdmin;
use App\{Type, User, SuperAdmin};

class StoreController extends Controller
{
    private const TYPE_MODEL_NAME = 'App\SuperAdmin';

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSuperAdmin $request Validation
     * 
     * @return RedirectResponse
     */
    public function __invoke(StoreSuperAdmin $request): RedirectResponse
    {
        $request->validated();

        $request['type_id'] = Type::findIDByModelName(self::TYPE_MODEL_NAME);

        $superadmin = SuperAdmin::createRow($request->all());

        $request['userable_id'] = $superadmin->id;
        $request['userable_type'] = self::TYPE_MODEL_NAME;

        User::createRow($request->all());

        return redirect()->route('superadmins.index')->with('success', 'Dodano');
    }
}
