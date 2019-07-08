<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\EquivalentAmont;
use App\Rules\Pesel;

class StoreWorker extends FormRequest
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
            'pesel' => ['nullable', 'digits:11', new Pesel],
            'equivalent' => ['required', 'numeric', Rule::in([0, 1])],
            'equivalent_amount' =>
                [
                    'numeric',
                    Rule::requiredIf($this->all()['equivalent'] == 1),
                    new EquivalentAmont($this->all()),
                ],
            'effective' => ['required', 'numeric', Rule::in([1, 3, 4])],
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
