<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 01.12.2015
 * Time: 17:46
 */

namespace App\Time;


use Illuminate\Support\Facades\Lang;

class Datetime implements \JsonSerializable
{
    /**
     * 1 Day
     */
    const SECONDS_IN = 86400;

    private $_day;
    private $_month;
    private $_year;

    private $_hour;
    private $_minute;
    private $_second;

    private $_format = 'Y-m-d H:i:s';

    /**
     * @param $dateTime
     */
    public function __construct( $dateTime = null )
    {
        if ( !$dateTime ) {
            $dateTime = date($this->_format);
        }

        $this->_parseDatetime( new FormatParser($this->_format, $dateTime) );
    }

    private function _parseDatetime( FormatParser $parser )
    {
        $day   = $parser->getDay();
        $month = $parser->getMonth();
        $year  = $parser->getYear();

        $hour   = $parser->getHour();
        $minute = $parser->getMinute();
        $second = $parser->getSecond();

        if ( !$day && !$month && !$year ) {
            $day    = (int) date('d');
            $month  = (int) date('m');
            $year   = (int) date('Y');

            $hour   = (int) date('H');
            $minute = (int) date('i');
            $second = (int) date('s');
        }
        $this->_day   = $day;
        $this->_month = $month;
        $this->_year  = $year;

        $this->_hour   = $hour;
        $this->_minute = $minute;
        $this->_second = $second;
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

    public function getDate()
    {
        return new Date($this->_day, $this->_month, $this->_year);
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
        return date("Y-m-d H:i:s",strtotime($this->_year.'-'.$this->_month.'-'.$this->_day.' '.$this->_hour.':'.$this->_minute.':'.$this->_second));
    }

    public function getTimestamp()
    {
        return mktime($this->_hour, $this->_minute, $this->_second, $this->_month, $this->_day, $this->_year);
    }

    public function getTimestampWithHour( Time $time )
    {
        return mktime($time->getHour(), $time->getMinutes(), $time->getSeconds(), $this->_month, $this->_day, $this->_year);
    }

    public function getNumber()
    {
        return date("w",strtotime($this->getDateYMD()));
    }

    public function getWeekDayName()
    {
        $dayNum = (int)date("l",strtotime($this->getDateYMD()));
        return Lang::get('days.'.$dayNum);
    }

    static public function parseDayFromYMDHis( $dateString )
    {
        $date = explode(' ', $dateString)[0];
        $date = explode('-', $date);

        return new Day($date[2], $date[1], $date[0]);
    }

    public function __toString()
    {
        return $this->getDateYMDHis();
    }

    public function timeAgo( Day $date )
    {
        return new TimeAgo($date, $this);
    }

    public function getHI()
    {
        return date('H:i', mktime( (int)$this->getHour(), (int)$this->getMinutes(), (int)$this->getSeconds(), 0,0,0));
    }

    public function getHour()
    {
        return $this->_hour
            ? $this->_hour
            : 0;
    }

    public function getMinutes()
    {
        return $this->_minute
            ? $this->_minute
            : 0;
    }

    public function getSeconds()
    {
        return $this->_second
            ? $this->_second
            : 0;
    }

    public function floorHours()
    {
        $this->_hour = 0;
        return $this;
    }

    public function floorMinutes()
    {
        $this->_minute = 0;
        return $this;
    }

    public function floorSeconds()
    {
        $this->_second = 0;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'ymd'         => $this->getDateYMD(),
            'dmy'         => $this->getDateDMY(),
            'ymdhis'      => $this->getDateYMDHis(),
            'hi'          => $this->getHI(),
            'hour'        => $this->getHour(),
            'minutes'     => $this->getMinutes(),
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