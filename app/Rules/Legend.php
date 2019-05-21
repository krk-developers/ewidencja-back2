<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
// use Carbon\{Carbon, CarbonPeriod};
use App\{Worker, User, Days};
use App\Rules\LegendHelper;

class Legend implements Rule
{
    private const FIELD_NAME = 'Pole ';
    private const WEEKEND_DAY_MESSAGE = ' nanosimy tylko na sobotę i niedzielę';
    private const WORKING_DAY_MESSAGE = ' nanosimy tylko na dni robocze';
    private const CHILDCARE_DAY_COUNT_MESSAGE = 'Maksymalnie dwa dni w roku';
    // private const MAXIMUM_CHILDCARE_DAY_COUNT = 2;

    private $request = [];
    private $workerID;
    // private $isWeekend = false;
    private $legend = null;
    private $childcareDayCountGreaterThen2 = false;
    private $start, $end;

    /**
     * Create a new rule instance.
     * 
     * @param array $request Request
     * @param int   $userID  User ID
     * 
     * @return void
     */
    public function __construct(array $request, int $userID)
    {
        $this->request = $request;

        $this->start = $request['start'];
        $this->end = $request['end'];

        $user = User::find_($userID);
        $this->workerID = $user->userable->id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute Attribute
     * @param mixed  $value     Value
     * 
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        // dd($attribute);  // legend_id
        // dd($value);  // 2

        $this->legend = LegendHelper::findLegend($value);
        $requestIsNotNull = LegendHelper::requestIsNotNull($this->start, $this->end);
        
        if ($requestIsNotNull === false) {
            return false;
        }

        switch($this->legend->name) {
            case 'Ś/CH':
                return Days::areWeekend($this->start, $this->end);
                break;
            case 'Ś/SZ':
                return Days::areWeekend($this->start, $this->end);
                break;
            case 'Ś/CHZ100':
                return Days::areWeekend($this->start, $this->end);
                break;
            case 'UW':
                return Days::areWorkingDays($this->start, $this->end);
                break;
            case 'UO':
                return Days::areWorkingDays($this->start, $this->end);
                break;
            case 'DOD':
                /*
                $carbon = new Carbon($this->request['start']);
                $year = $carbon->year;
                $childcareDayCount = Worker::childcareDayCount(
                    $this->workerID,
                    $year
                );
                
                if ($childcareDayCount >= self::MAXIMUM_CHILDCARE_DAY_COUNT) {
                    $this->childcareDayCountGreaterThen2 = true;

                    return false;
                }
                */

                return Days::areWorkingDays($this->start, $this->end);
                break;
            default:
                return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        /*
        if ($this->legend == null) {
            return 'Wypełnij pola początek i koniec';
        }
        */
        switch($this->legend->name) {
            case 'Ś/CH':
                return self::FIELD_NAME . 
                    $this->legend->name . self::WEEKEND_DAY_MESSAGE;
                break;
            case 'Ś/SZ':
                return self::FIELD_NAME . 
                    $this->legend->name . self::WEEKEND_DAY_MESSAGE;
                break;
            case 'Ś/CHZ100':
                return self::FIELD_NAME . 
                    $this->legend->name . self::WEEKEND_DAY_MESSAGE;
                break;
            case 'UW':
                return self::FIELD_NAME .
                    $this->legend->name . self::WORKING_DAY_MESSAGE;
                break;
            case 'UO':
                return self::FIELD_NAME .
                    $this->legend->name . self::WORKING_DAY_MESSAGE;
                break;
                case 'DOD':
                    if ($this->childcareDayCountGreaterThen2) {
                        return self::CHILDCARE_DAY_COUNT_MESSAGE;
                    }

                    return self::FIELD_NAME .
                        $this->legend->name . self::WORKING_DAY_MESSAGE;
                break;
            default:
                'Nieznany błąd';
        }
    }
}
