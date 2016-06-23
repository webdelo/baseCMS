<?php
namespace App\Schedule\Iterators;

use App\Time\Date;
use App\Time\Datetime;
use App\Time\Time;

class TimeIterator implements \Iterator, \JsonSerializable
{
    protected $_date;
    protected $_times = [] ;
    private $iteration;
    private $iterationStep = 1; // 1 Hour
    private $hours;

    private $startTime   = '08:30:00';
    private $startTimeObject;

    private $finishTime  = '17:00:00';
    private $finishTimeObject;

    private $startLunch  = '13:00:00';
    private $startLunchObject;

    private $finishLunch = '14:00:00';
    private $finishLunchObject;

    public function __construct( Date $date )
    {
        $this->_date = $date;
        $this->generateHours();

    }

    private function getStartTime()
    {
        if ( !$this->startTimeObject ) {
            $this->startTimeObject = new Time($this->startTime);
        }
        return $this->startTimeObject;
    }

    private function getFinishTime()
    {
        if ( !$this->finishTimeObject ) {
            $this->finishTimeObject = new Time($this->finishTime);
        }
        return $this->finishTimeObject;
    }

    private function getStartLunch()
    {
        if ( !$this->startLunchObject ) {
            $this->startLunchObject = new Time($this->startLunch);
        }
        return $this->startLunchObject;
    }

    private function getFinishLunch()
    {
        if ( !$this->finishLunchObject ) {
            $this->finishLunchObject = new Time($this->finishLunch);
        }
        return $this->finishLunchObject;
    }

    private function getDate()
    {
        return $this->_date;
    }
    
    private function generateHours()
    {
        $time = $this->getStartTime()->getHour();
        while( $time < $this->getStartLunch()->getHour() ) {
            $this->_times[] = new Datetime( $this->getDate()->getDateYMD() .' '. $time.':'.$this->getStartTime()->getMinutes().':'.$this->getStartTime()->getSeconds() );
            $time = $time+1;
        }

        $time = $this->getFinishLunch()->getHour();
        while( $time <= $this->getFinishTime()->getHour() ) {
            $this->_times[] = new Datetime( $this->getDate()->getDateYMD() .' '. $time.':'.$this->getFinishLunch()->getMinutes().':'.$this->getFinishLunch()->getSeconds() );
            $time = $time+1;
        }
        return $this->_times;
    }

    function rewind()
    {
        $this->iteration = 1;
        reset($this->_times);
    }

    function current()
    {
        return current($this->_times);
    }

    function key()
    {
        return key($this->_times);
    }

    function next()
    {
        $this->iteration++;
        next($this->_times);
    }

    function valid()
    {
        return !!(current($this->_times));
    }

    function iteration()
    {
        return $this->iteration;
    }

    public function jsonSerialize()
    {
        return $this->_times;
    }
}