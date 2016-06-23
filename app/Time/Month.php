<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 01.12.2015
 * Time: 17:45
 */

namespace App\Time;


class Month
{
    private $_year;
    private $_month;

    /**
     * 1 Month (30.44 days)
     */
    const SECONDS_IN = 2629743;

    public function __construct($month, $year)
    {
        $this->_month = (int)$month;
        $this->_year = (int)$year;
    }

    public function getStartDay()
    {
        $day = new Day(1, $this->_month, $this->_year);
        return $day;
    }

    public function getFirstDay()
    {
        return $this->getStartDay();
    }

    public function getEndDay()
    {
        $day = new Day($this->countDays(), $this->_month, $this->_year);
        return $day;
    }

    public function getLastDay()
    {
        return $this->getEndDay();
    }
    
    public function countDays()
    {
        return date('t', $this->_month);
    }

    public function getName()
    {
        return date('F');
    }
}