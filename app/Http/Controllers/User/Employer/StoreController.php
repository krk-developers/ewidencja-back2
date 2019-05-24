<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\{Type, User, Employer};
use App\Http\Requests\StoreEmployer;

class StoreController extends Controller
{
    private const TYPE_MODEL_NAME = 'App\Employer';

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEmployer $request Validator
     * 
     * @return RedirectResponse
     */
    public function __invoke(StoreEmployer $request)//: RedirectResponse Request
    {
        // return $request;
        $validated = $request->validated();

        $request['type_id'] = Type::findIDByModelName(self::TYPE_MODEL_NAME);

        $employer = Employer::createRow($request->all());

        $request['userable_id'] = $employer->id;
        $request['userable_type'] = self::TYPE_MODEL_NAME;

        User::createRow($request->all());

        return redirect()->route('employers.index')->with('success', 'Dodano');
    }
}
