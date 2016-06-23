<?php
namespace app\Schedule\Iterators;


use App\Time\Time;

class ScheduleTime
{
    private $_time;

    public function __construct( Time $time )
    {
        $this->_time = $time;
    }

    private function getTime()
    {
        return $this->_time;
    }

    public function getValue()
    {
        return $this->getTime()->getHI();
    }

    public function getDoctors()
    {

    }
}