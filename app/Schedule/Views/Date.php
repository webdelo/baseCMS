<?php
namespace App\Schedule\Views;

use App\Doctors\Models\Doctor;
use App\Schedule\Iterators\TimeIterator;
use App\Schedule\ScheduleHandler;
use App\Schedule\ScheduleTimeIterator;
use \App\Time\Date as AppDate;
use App\Time\Datetime;
use App\Visits\Models\Visit;
use Illuminate\Support\Facades\View;

class Date implements \JsonSerializable
{
    private $_date;
    private $_times;

    public function __construct( AppDate $date )
    {
        $this->_date = $date;
    }

    private function getDate()
    {
        return $this->_date;
    }

    private function getTimes()
    {
        if ( !$this->_times ) {
            $this->_times = new ScheduleTimeIterator($this->_date);
        }
        return $this->_times;
    }

    private function getDoctors()
    {
        $doctors = Doctor::with('employee')->get();

        return $doctors;
    }

    private function countVisits()
    {
        $visits = new Visit();
        $visits->where('date', '>', $this->getTime()->floorMinutes()->floorSeconds())
               ->where('date', '<', $this->getTomorrow());

        return $visits->count();
    }

    private function getTime()
    {
        return new Datetime();
    }

    private function getTomorrow()
    {
        $now = new Datetime();
        return $now->getDate()->getNext();
    }

    public function printTemplate()
    {
        return View::make('schedule.calendar.day', [
            'date'      => $this->getDate(),
            'nextDate'  => $this->getDate()->getNext(),
            'prevDate'  => $this->getDate()->getPrev(),
            'times'     => $this->getTimes(),
            'doctors'   => $this->getDoctors(),
            'now'       => $this->getTime()->floorMinutes()->floorSeconds(),
            'scheduler' => new ScheduleHandler($this->getDate())
        ]);
    }

    public function jsonSerialize()
    {
        return [
            'date'      => $this->getDate(),
            'nextDate'  => $this->getDate()->getNext(),
            'prevDate'  => $this->getDate()->getPrev(),
            'times'     => $this->getTimes(),
            'doctors'   => $this->getDoctors(),
            'now'       => $this->getTime()->floorMinutes()->floorSeconds(),
        ];
    }

}