<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\{Carbon, CarbonPeriod};
use App\{Legend, Worker, User, Days};

class StartEvent implements Rule
{
    private const FIELD_NAME = 'Pole ';
    private const WEEKEND_DAY_MESSAGE = ' nanosimy tylko na sobotę i niedzielę';
    private const WORKING_DAY_MESSAGE = ' nanosimy tylko na dni robocze';
    private const CHILDCARE_DAY_COUNT_MESSAGE = 'Maksymalnie dwa dni w roku';
    private const MAXIMUM_CHILDCARE_DAY_COUNT = 2;

    private $request = [];
    private $workerID;
    private $isWeekend = false;
    private $legend = null;
    private $childcareDayCountGreaterThen2 = false;

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
        if ($this->request['start'] == null || $this->request['end'] == null) {
            return false;
        }
        
        $this->legend = Legend::find_($value);
        
        $isWeekend1 = Days::isWeekend($this->request['start']);
        $isWeekend2 = Days::isWeekend($this->request['end']);

        switch($this->legend->name) {
            case 'Ś/CH':
                return ($isWeekend1 && $isWeekend2);
                break;
            case 'UW':
                $timePeriod = CarbonPeriod::between(
                    $this->request['start'],
                    $this->request['end']
                );
                return Days::areWorkingDays($timePeriod);
                break;
            case 'DOD':
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

                return (! $isWeekend1 && ! $isWeekend2);  // only working days
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
        if ($this->legend == null) {
            return 'Wypełnij pola początek i koniec';
        }

        switch($this->legend->name) {
            case 'Ś/CH':
                return self::FIELD_NAME . 
                    $this->legend->name . self::WEEKEND_DAY_MESSAGE;
                break;
            case 'UW':
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

    /**
     * Is the weekend
     *
     * @param string $dt Date time, format YYYY-MM-DD
     * 
     * @return boolean
     */
    /*
    private function isWeekend(string $dt)
    {
        $startEvent = new Carbon($dt);
        $this->isWeekend = $startEvent->isWeekend();

        return $this->isWeekend;
    }
    */
}
