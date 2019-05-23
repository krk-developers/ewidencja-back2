<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
// use Carbon\{Carbon, CarbonPeriod};
use App\{Worker, User, Days};
use App\Rules\LegendHelper;
use App\Http\Requests\StoreEvent;

class Legend implements Rule
{
    private const FIELD_NAME = 'Pole ';
    private const WEEKEND_DAY_MESSAGE = ' nanosimy tylko na sobotę i niedzielę.';
    private const WORKING_DAY_MESSAGE = ' nanosimy tylko na dni robocze.';
    private const CHILDCARE_DAY_COUNT_MESSAGE = 'Maksymalnie dwa dni w roku.';
    private const EVENTS_OVERLAP_MESSAGE = 'Wydarzenia nie mogą się pokrywać';

    private $_worker;
    private $_legend = null;
    private $_childcareDayMax = false;
    private $_eventStart, $_eventEnd;
    private $_eventsOverlap = false;

    /**
     * Create a new rule instance.
     * 
     * @param StoreEvent $storeEvent StoreEvent
     * 
     * @return void
     */
    public function __construct(StoreEvent $storeEvent)
    {
        $workerID = (int) $storeEvent->segment(2);
        $this->_worker = Worker::findRow($workerID);
        $employerID = (int) $storeEvent->segment(4);
        // dd($employerID);
        $this->_eventStart = $storeEvent['start'];
        $this->_eventEnd = $storeEvent['end'];
        // dd($this->_eventStart);
        $eventsCount = LegendHelper::eventsOverlap(
            $this->_worker, $employerID, $this->_eventStart, $this->_eventEnd
        );
        // dd($events->count());
        if ($eventsCount > 0) {
            $this->_eventsOverlap = true;
        }
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

        $this->_legend = LegendHelper::findLegend($value);

        $requestIsNotNull = LegendHelper::requestIsNotNull(
            $this->_eventStart, $this->_eventEnd
        );
        
        if ($requestIsNotNull === false) {
            return false;
        }

        if ($this->_eventsOverlap) {
            return false;
        }

        switch($this->_legend->name) {
            case 'Ś/CH':
                return Days::areWeekend($this->_eventStart, $this->_eventEnd);
                break;
            case 'Ś/SZ':
                return Days::areWeekend($this->_eventStart, $this->_eventEnd);
                break;
            case 'Ś/CHZ100':
                return Days::areWeekend($this->_eventStart, $this->_eventEnd);
                break;
            case 'UW':
                return Days::areWorkingDays($this->_eventStart, $this->_eventEnd);
                break;
            case 'UO':
                return Days::areWorkingDays($this->_eventStart, $this->_eventEnd);
                break;
            case 'DOD':
                $childcareDayValid = LegendHelper::timePeriodChildcareDaysNumber(
                    $this->_eventStart, $this->_eventEnd
                );
                if ($childcareDayValid == false) {
                    $this->_childcareDayMax = true;

                    return false;
                }

                $childcareDayValid = LegendHelper::childcareDaysNumber(
                    $this->_worker, $this->_eventStart
                );
                if ($childcareDayValid == false) {
                    $this->_childcareDayMax = true;

                    return false;
                }                

                $areWorkingDays = Days::areWorkingDays(
                    $this->_eventStart, $this->_eventEnd
                );
                if ($areWorkingDays == false) {
                    return false;
                }
                // TODO working days
                return true;
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

        if ($this->_eventsOverlap) {
            return self::EVENTS_OVERLAP_MESSAGE;
        }
        
        switch($this->_legend->name) {
            case 'Ś/CH':
                return self::FIELD_NAME . 
                    $this->_legend->name . self::WEEKEND_DAY_MESSAGE;
                break;
            case 'Ś/SZ':
                return self::FIELD_NAME . 
                    $this->_legend->name . self::WEEKEND_DAY_MESSAGE;
                break;
            case 'Ś/CHZ100':
                return self::FIELD_NAME . 
                    $this->_legend->name . self::WEEKEND_DAY_MESSAGE;
                break;
            case 'UW':
                return self::FIELD_NAME .
                    $this->_legend->name . self::WORKING_DAY_MESSAGE;
                break;
            case 'UO':
                return self::FIELD_NAME .
                    $this->_legend->name . self::WORKING_DAY_MESSAGE;
                break;
                case 'DOD':
                    if ($this->_childcareDayMax) {
                        return self::CHILDCARE_DAY_COUNT_MESSAGE;
                    }

                    return self::FIELD_NAME .
                        $this->_legend->name . self::WORKING_DAY_MESSAGE;
                break;
            default:
                'Nieznany błąd';
        }
    }
}
