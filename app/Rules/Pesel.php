<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Pesel implements Rule
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
    public function passes($attribute, $value)
    {
        return $this->isPeselCheckSumOk($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Nieprawidłowy PESEL.';
    }

    /**
     * Check sum.
     *
     * @param string $pesel Pesel
     * 
     * @return boolean
     */
    private function isPeselCheckSumOk(string $pesel): bool
    {
        // tablica z odpowiednimi wagami
        $arrWagi = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        $intSum = 0;

        for ($i = 0; $i < 10; $i++) {
            // mnożymy każdy ze znaków dla 10 pierwszych cyfr
            // przez wagę i sumujemy wszystko
            $intSum += $arrWagi[$i] * $pesel[$i];
        }

        // obliczamy sumę kontrolną i porównujemy ją z ostatnią cyfrą.
        $int = 10 - $intSum % 10;
        // sprawdzamy czy taka sama suma kontrolna jest w ciągu
        $intControlNr = ($int == 10) ? 0 : $int;
        
        if ($intControlNr == $pesel[10]) {
           return true;
        }
        
        return false;
    }
}
