<?php
namespace app\Schedule\Iterators;


use App\Employees\Models\Doctor;
use App\Employees\Models\Employee;
use App\Visits\Models\Visit;
use Eloquent;
use App\User;

class ScheduleDoctor {

    private $_time;
    private $_visit;

    public function __construct( ScheduleTime $time )
    {
        $this->_time = $time;
    }

    private function getVisit()
    {
        if ( !$this->_visit ) {

            $this->_visit = Visit::where('date', '=', $this->time);
        }

        return $this->_visit;
    }


    public function getDoctor()
    {
        return $this->getVisit()->doctor;
    }

    public function hasPatient()
    {
        return ($this->getVisit());
    }
}