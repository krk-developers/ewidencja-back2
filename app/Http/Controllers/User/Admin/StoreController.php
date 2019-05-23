<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreAdmin;

use App\{Type, User, Admin};

class StoreController extends Controller
{
    private const TYPE_MODEL_NAME = 'App\Admin';

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAdmin $request Validation
     * 
     * @return RedirectResponse
     */
    public function __invoke(StoreAdmin $request): RedirectResponse
    {
        $validated = $request->validated();

        $request['type_id'] = Type::findIDByModelName(self::TYPE_MODEL_NAME);

        $admin = Admin::createRow($request->all());

        $request['userable_id'] = $admin->id;
        $request['userable_type'] = self::TYPE_MODEL_NAME;

        User::createRow($request->all());

        return redirect()->route('admins.index')->with('success', 'Dodano');
    }
}
