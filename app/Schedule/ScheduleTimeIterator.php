<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 05.06.2016
 * Time: 21:35
 */

namespace App\Schedule;


use App\Doctors\Models\Doctor;
use App\Schedule\Iterators\TimeIterator;
use App\Time\Date;

class ScheduleTimeIterator extends TimeIterator implements \JsonSerializable
{
    private $_schedule_times = [];

    public function __construct( Date $date )
    {
        parent::__construct($date);
    }

    public function jsonSerialize()
    {
        foreach( $this->_times as $key=>$time )
        {
            $this->_schedule_times[$key]['time'] = $time;

            $handler = new ScheduleHandler($this->_date);
            $doctors = Doctor::all();
            foreach($doctors as $doctor) {
                $res = $handler->getPatient($doctor, $time);
                $this->_schedule_times[$key]['visits'][] = $res
                    ? $handler->getPatient($doctor, $time)
                    : [ 'doctorId' => $doctor->id ];
            }
        }

        return $this->_schedule_times;
    }
}