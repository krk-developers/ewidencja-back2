<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Nip implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $this->validNIP($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Niepoprawny NIP';
    }

    /**
     * NIP validation.
     *
     * @param string $nip NIP
     * 
     * @return boolean
     */
    private function validNIP(string $nip): bool
    {
        if (strlen($nip) !== 10) {
            return false;
        }

        $arrSteps = [6, 5, 7, 2, 3, 4, 5, 6, 7];
        $intSum = 0;
     
        for ($i = 0; $i < 9; $i++) {
            $intSum += $arrSteps[$i] * $nip[$i];
        }
     
        $int = $intSum % 11;
        $intControlNr = $int === 10 ? 0 : $int;
     
        if ($intControlNr == $nip[9]) {
            return true;
        }
     
        return false;
    }
}
