<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EquivalentAmont;

class StoreWorker extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;  // false;
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
            'pesel' => ['nullable', 'digits:11'],
            'contract_from' => ['required'],
            'part_time' => ['required', 'numeric'],
            'equivalent' => ['required', 'numeric'],
            'equivalent_amount' =>
                [
                    'numeric',
                    new EquivalentAmont($this->all()),
                ],
            'effective' => ['numeric'],
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
