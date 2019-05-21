<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EquivalentAmont implements Rule
{
    private $request = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // dd($this->request['equivalent_amount']);
        if (intval($this->request['equivalent']) === 1) {                        
            if (intval($this->request['equivalent_amount']) === 0) {
                return false;
            }
            if ($this->request['equivalent_amount'] === null) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Kwota ekwiwalentu nie może wynosić 0.';
    }
}
