<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 01.12.2015
 * Time: 17:46
 */

namespace App\Time;


use Illuminate\Support\Facades\Lang;

class Date implements \JsonSerializable
{
    /**
     * 1 Day
     */
    const SECONDS_IN = 86400;

    private $_day;
    private $_month;
    private $_year;

    /**
     * @param int $day 1-31
     * @param int $month 1-12
     * @param int $year 1977-3000
     */
    public function __construct( $day=null, $month=null, $year=null )
    {
        if ( !$day && !$month && !$year ) {
            $day   = (int) date('d');
            $month = (int) date('m');
            $year  = (int) date('Y');
        }
        $this->_day   = $day;
        $this->_month = $month;
        $this->_year  = $year;
    }

    public function getDay()
    {
        return $this->_day;
    }

    public function getMonth()
    {
        return $this->_month;
    }

    public function getMonthName()
    {
        $month = (int)$this->_month;
        return Lang::get('months.'.$month);
    }

    public function getYear()
    {
        return $this->_year;
    }

    public function isWeekend()
    {
        return in_array($this->getNumber(), [0,6]);
    }

    public function getDateDMY()
    {
        return date("d-m-Y",strtotime($this->_year.'-'.$this->_month.'-'.$this->_day));
    }

    public function getDateYMD()
    {
        return date("Y-m-d",strtotime($this->_year.'-'.$this->_month.'-'.$this->_day));
    }

    public function getDateYMDHis()
    {
        return date("Y-m-d H:i:s",strtotime($this->_year.'-'.$this->_month.'-'.$this->_day.' 00:00:00'));
    }

    public function getTimestamp()
    {
        return mktime(0, 0, 0, $this->_month, $this->_day, $this->_year);
    }

    public function getTimestampWithHour( Time $time )
    {
        return mktime($time->getHour(), $time->getMinutes(), $time->getSeconds(), $this->_month, $this->_day, $this->_year);
    }

    public static function createDateByTimestamp( $timestamp )
    {
        $day   = date('d', $timestamp);
        $month = date('m', $timestamp);
        $year  = date('Y', $timestamp);

        return new Date( (int)$day, (int)$month, (int)$year );
    }

    public function getNumber()
    {
        return date("w",strtotime($this->getDateYMD()));
    }

    public function getWeekDayName()
    {
        return Lang::get('days.'.$this->getNumber());
    }

    static public function parseDayFromYMDHis( $dateString )
    {
        $date = explode(' ', $dateString)[0];
        $date = explode('-', $date);

        return new Day($date[2], $date[1], $date[0]);
    }

    public function __toString()
    {
        return $this->getDateDMY();
    }

    public function timeAgo( Day $date )
    {
        return new TimeAgo($date, $this);
    }

    public function getNext()
    {
        return self::createDateByTimestamp($this->getTimestamp() + self::SECONDS_IN);
    }

    public function getPrev()
    {
        return self::createDateByTimestamp($this->getTimestamp() - self::SECONDS_IN);
    }

    public function jsonSerialize()
    {
        return [
            'ymd'         => $this->getDateYMD(),
            'dmy'         => $this->getDateDMY(),
            'weekDayName' => $this->getWeekDayName(),
            'monthName'   => $this->getMonthName(),
            'day'         => $this->getDay(),
            'month'       => $this->getMonth(),
            'year'        => $this->getYear(),
            'timestamp'   => $this->getTimestamp(),
            'isWeekend'   => $this->isWeekend()
        ];
    }
}