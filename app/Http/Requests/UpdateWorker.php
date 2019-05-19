<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => ['required', 'string', 'max:191'],
            'pesel' => ['nullable', 'digits:11']
        ];
    }
}
