<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 07.05.2016
 * Time: 14:17
 */

namespace App\Schedule;


use App\Doctors\Models\Doctor;
use App\Schedule\Models\Schedule;
use App\Time\Date;
use App\Time\Datetime;
use App\Time\Time;
use App\Visits\Models\Visit;

class ScheduleHandler
{
    private $_date;
    private $_visits = [];

    public function __construct( Date $date )
    {
        $this->_date = $date;
    }

    private function getDate()
    {
        return $this->_date;
    }

    public function existPatient( Doctor $doctor, Datetime $time )
    {
        return (boolean)$this->getPatient($doctor, $time);
    }

    public function getPatient( Doctor $doctor, Datetime $time )
    {
        if ( isset($this->_visits[$doctor->id][$time->getTimestamp()]) )
            return $this->_visits[$doctor->id][$time->getTimestamp()];


        $visit = Visit::where('doctorId', '=', $doctor->id)->with('patient')->whereRaw(' UNIX_TIMESTAMP(date) = ?', [$time->getTimestamp()]);

        if ( $visit->count() != 0 ) {
            $this->_visits[$doctor->id][$time->getTimestamp()] = $visit->first();
            return $this->_visits[$doctor->id][$time->getTimestamp()];
        }
        return false;
    }
}