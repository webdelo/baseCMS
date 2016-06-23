<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 16.01.2016
 * Time: 14:08
 */
namespace App\Time;

use Illuminate\Support\Facades\Lang;

class TimeAgo
{
    private $_date;
    private $_dateAgo;
    private $_sum;
    private $_sumDays;
    private $_type = 'timeAgoAfter';

    public function __construct( Day $date, Day $dateAgo )
    {
        $this->_date    = $date;
        $this->_dateAgo = $dateAgo;
        $this->calculateSum();
    }

    public function get()
    {
        $sum = $this->getSumDays();
        if ( $sum < 1 ) {
            $minutes = $this->getSum() / 60;
            if ( $minutes < 60 )
                return $this->getMinutes();

            if ( $minutes > 60 )
                return $this->getHours();
        }
        if ( $sum < 7  ) {
            if ($sum==1) {
                return $this->getCaption($sum, 'oneDay');
            }
            if ( $sum==2 ) {
                return $this->getCaption($sum, 'oneMoreDay');
            }

            return $this->getDays();
        }


        if ( $sum >= 7 && $sum < 30 )
            return $this->getWeeks();

        if ( $sum >= 30 && $sum < 365 ) {
            return $this->getMonths();
        }
        return $this->getYears();
    }

    private function calculateSum()
    {
        $this->_sum = $this->getDateAgo()->getTimestamp() - $this->getDate()->getTimestamp();
        if ( $this->_sum < 0 ) {
            $this->_type = 'timeAgoBefore';
            $this->_sum  = $this->_sum * -1;
        }
        $this->_sumDays = $this->_sum / Day::SECONDS_IN;
    }

    private function getSum()
    {
        return $this->_sum;
    }

    private function getSumDays()
    {
        return $this->_sumDays;
    }

    private function getDateAgo()
    {
        return $this->_dateAgo;
    }

    private function getDate()
    {
        return $this->_date;
    }

    public function __toString()
    {
        return (string)$this->get();
    }

    public function getDays()
    {
        return $this->getCaption(intval($this->getSum() / Day::SECONDS_IN), 'days');
    }

    public function getWeeks()
    {
        return $this->getCaption(intval($this->getSum() / Week::SECONDS_IN), 'weeks');
    }

    public function getMonths()
    {
        return $this->getCaption(intval($this->getSum() / Month::SECONDS_IN), 'months');
    }

    public function getYears()
    {
        return $this->getCaption(intval($this->getSum() / Year::SECONDS_IN), 'years');
    }

    public function getMinutes()
    {
        return $this->getCaption(intval($this->getSum() / 60), 'minutes');
    }

    public function getHours()
    {
        return $this->getCaption(intval($this->getSum() / (60 * 60)), 'hours');
    }

    private function declension($int, $expr = array(1,2,3)){
        settype($int, "integer");
        $count = $int % 100;
        if ($count >= 5 && $count <= 20) {
            $result = $expr['2'];
        } else {
            $count = $count % 10;
            if ($count == 1) {
                $result = $expr['0'];
            } elseif ($count >= 2 && $count <= 4) {
                $result = $expr['1'];
            } else {
                $result = $expr['2'];
            }
        }
        return $result;
    }

    private function getCaption($value, $type)
    {
        return Lang::get($this->_type.'.'.$type.'.'.$this->declension($value), [ 'value' => $value ]);
    }
}