<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditWorker extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;  // false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lastname' => ['max:30'],
            'name' => ['required', 'string', 'max:191'],
            'pesel' => ['nullable', 'digits:11']
        ];
    }
}
