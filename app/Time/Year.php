<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 01.12.2015
 * Time: 17:44
 */

namespace App\Time;


class Year
{
    private $_year;
    private $_frames = [ 1977, 3000 ];

    private $_weekends;
    private $_months;
    /**
     * 1 Year
     */
    const SECONDS_IN = 31556926;

    /**
     * @param int $year 1977-3000
     */
    public function __construct($year)
    {
        $this->validYear($year);

        $this->_year = $year;
    }

    private function validYear($year)
    {
        if ( !is_numeric($year) ) {
            throw new \Exception('Invalid parameter for initializate Year object');
        }
        if ( $year < $this->_frames[0] || $year > $this->_frames[1] ) {
            throw new \Exception('Invalid year value for initializate Year object');
        }
    }

    public function weekends()
    {
        if ( !$this->_weekends ) {
            for ($month = 1; $month <=12; $month++) {
                for($day = 1; $day <= date("t",strtotime($this->_year.'-'.$month)); $day++) {
                    $dayObj = new Day($day, $month, $this->_year);
                    if ( $dayObj->isWeekend() ) {
                        $this->_weekends[] = $dayObj;
                    }
                }
            }
        }
        return $this->_weekends;
    }

    public function months()
    {
        if ( !$this->_months ) {
            for ($i = 1; $i <=12; $i++) {
                $month = new Month($i, $this->_year);
                $this->_months[] = $month;
            }
        }
        return $this->_months;
    }

    public function getYear()
    {
        return $this->_year;
    }

    public function getTimestamp()
    {
        return mktime(0, 0, 0, 0, 0, $this->getYear());
    }
}