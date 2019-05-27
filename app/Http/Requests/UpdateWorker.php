<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EquivalentAmont;
use Illuminate\Validation\Rule;

class UpdateWorker extends FormRequest
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
            'lastname' => ['max:30'],
            'equivalent' => ['required', 'numeric', Rule::in([0, 1])],
            'equivalent_amount' =>
                [
                    'numeric',
                    Rule::requiredIf($this->all()['equivalent'] == 1),
                    new EquivalentAmont($this->all())
                ],
            'effective' => ['required', 'numeric', Rule::in([1, 3, 4])],
            'name' => ['required', 'string', 'max:191'],
            // 'pesel' => ['nullable', 'digits:11']
        ];
    }
}
                /*
                [
                    Rule::requiredIf($this->all()['equivalent'] == 1),
                    'numeric',
                    // 'digits_between:1,10000'
                ],
                */
