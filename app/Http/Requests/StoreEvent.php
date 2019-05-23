<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\{Legend, Date};

class StoreEvent extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'legend_id' =>
                [
                    'required',
                    'numeric',
                    new Legend($this),
                ],
            'employer_id' => ['required', 'numeric'],
            'worker_id' => ['required', 'numeric'],
            'start' => 
                [
                    'required',
                    'date',
                    new Date($this->all()),
                ],
            'end' => ['required', 'date'],
            'title' => ['max:80'],
        ];
    }
}
