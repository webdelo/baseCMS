<?php namespace App\Time;

class FormatParser
{
    private $_date;
    private $_time;

    private $_formatDate;
    private $_formatTime;

    /**
     * @param $format
     * @param $datetime
     */
    public function __construct( $format, $datetime )
    {
        $this->setDatetime($datetime)
             ->setFormat($format);
    }

    private function setDatetime( $datetime )
    {
        $datetime = explode(' ', $datetime);

        $this->setDate($datetime[0]);

        if ( isset($datetime[1]) ) {
            $this->setTime($datetime[1]);
        }


        return $this;
    }

    private function setDate( $date )
    {
        $this->_date = explode('-', $date);
        return $this;
    }

    private function setTime( $time )
    {
        $this->_time = explode(':', $time);
        return $this;
    }

    private function setFormat( $format )
    {
        $format = explode(' ', $format);
        $this->setFormatDate($format[0]);

        if ( isset($format[1]) ) {
            $this->setFormatTime($format[1]);
        }

    }

    private function setFormatDate($formatDate)
    {
        $this->_formatDate = array_flip(explode('-', $formatDate));
        return $this;
    }

    private function setFormatTime($formatTime)
    {
        $this->_formatTime = array_flip(explode(':', $formatTime));
        return $this;
    }

    public function getDay()
    {
        return isset($this->_date[ $this->_getDayIndex() ]) ? $this->_date[ $this->_getDayIndex() ] : 0;
    }

    private function _getDayIndex()
    {
        return $this->_formatDate['d'];
    }

    public function getMonth()
    {
        return isset($this->_date[ $this->_getMonthIndex() ]) ? $this->_date[ $this->_getMonthIndex() ] : 0;
    }

    private function _getMonthIndex()
    {
        return $this->_formatDate['m'];
    }

    public function getYear()
    {
        return isset($this->_date[ $this->_getYearIndex() ]) ? $this->_date[ $this->_getYearIndex() ] : 0;
    }

    private function _getYearIndex()
    {
        return $this->_formatDate['Y'];
    }

    public function getHour()
    {
        return isset($this->_time[ $this->_getHourIndex() ]) ? $this->_time[ $this->_getHourIndex() ] : 0;
    }

    private function _getHourIndex()
    {
        return $this->_formatTime['H'];
    }

    public function getMinute()
    {
        return isset($this->_time[ $this->_getMinuteIndex() ]) ? $this->_time[ $this->_getMinuteIndex() ] : 0;
    }

    private function _getMinuteIndex()
    {
        return $this->_formatTime['i'];
    }

    public function getSecond()
    {
        return isset($this->_time[ $this->_getSecondIndex() ]) ? $this->_time[ $this->_getSecondIndex() ] : 0;
    }

    private function _getSecondIndex()
    {
        return isset($this->_formatTime['s']) ? $this->_formatTime['s'] : 0;
    }
}