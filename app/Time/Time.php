<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 01.12.2015
 * Time: 19:14
 */

namespace App\Time;


class Time
{
    private $_hour;
    private $_minutes;
    private $_seconds;

    public function __construct( $time )
    {
        $this->validTime($time);

        $time = explode(':', $time);

        $this->_hour    = isset($time[0])
            ? $time[0]
            : 0 ;

        $this->_minutes = isset($time[1])
            ? $time[1]
            : 0 ;

        $this->_seconds = isset($time[2])
            ? $time[2]
            : 0 ;


    }

    public function getHour()
    {
        return $this->_hour
            ? $this->_hour
            : 0;
    }

    public function getMinutes()
    {
        return $this->_minutes
            ? $this->_minutes
            : 0;
    }

    public function getSeconds()
    {
        return $this->_seconds
            ? $this->_seconds
            : 0;
    }

    public function getHIS()
    {
        return date('H:i:s', mktime( (int)$this->getHour(), (int)$this->getMinutes(), (int)$this->getSeconds(), 0,0,0));
    }

    public function getHI()
    {
        return date('H:i', mktime( (int)$this->getHour(), (int)$this->getMinutes(), (int)$this->getSeconds(), 0,0,0));
    }

    private function validTime($time)
    {
        if ( is_null($time) ) {
            throw new \Exception('Time can\'t be null');
        }
    }

    static function parseTimeFromYMDHis( $dateString )
    {
        $date = explode(' ', $dateString)[1];

        return new Time($date);
    }

    public function __toString()
    {
        return $this->getHIS();
    }

    public function getTimestampByDate( Date $date )
    {
        return mktime($this->getHour(), $this->getMinutes(), $this->getSeconds(), $date->getMonth(), $date->getDay(), $date->getYear());
    }
}