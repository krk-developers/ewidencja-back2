<?php

declare(strict_types = 1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Days;
use App\Rules\LegendHelper;

class Date implements Rule
{
    /**
     * User's data
     *
     * @var array
     */
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
     * @param string $attribute Field name
     * @param mixed  $value     Field value
     * 
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $start = $value;
        $end = $this->request['end'];
        
        $requestIsNotNull = LegendHelper::requestIsNotNull($start, $end);
        if ($requestIsNotNull === false) {
            return false;
        }
        
        return Days::correctOrder($start, $end);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Data początkowa musi być wcześniejsza lub taka sama jak końcowa.';
    }
}
