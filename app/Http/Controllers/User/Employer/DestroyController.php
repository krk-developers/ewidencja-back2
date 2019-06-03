<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User\Employer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Employer;

class DestroyController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param Request  $request  Request
     * @param Employer $employer Employer
     * 
     * @return View|RedirectResponse
     */
    public function __invoke(Request $request, Employer $employer): object
    {
        $this->authorize('delete', $employer);

        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            $employer->deleteRow();

            return redirect()
                ->route('employers.index')
                ->with('success', 'Usunięto');
        }

        if ($delete == 'No') {
            return redirect()->route('employers.show', $employer->id);
        }

        return view(
            'user.employer.destroy',
            ['employer' => $employer]
        );
    }
}
