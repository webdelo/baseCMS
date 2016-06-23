<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 05.05.2016
 * Time: 18:16
 */

namespace app\Schedule\Iterators;


use App\Time\Date;

class ScheduleDay
{
    private $_date;

    public function __construct( Date $date )
    {
        $this->_date = $date;
    }

    private function getDate()
    {
        return $this->_date;
    }

    public function getTimes()
    {
        return new ScheduleTimes($this->getDate());
    }
}