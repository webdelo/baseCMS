<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 15.05.2016
 * Time: 11:43
 */

namespace App\Schedule;


use App\Doctors\Models\Doctor;
use App\Patients\Models\Patient;
use App\Time\Datetime;
use App\Visits\Models\Visit;
use Illuminate\Support\Facades\Auth;

class ScheduleVisitCreator
{
    private $_doctor;
    private $_patient;
    private $_datetime;

    public function __construct( Doctor $doctor, Datetime $datetime )
    {
        $this->_datetime = $datetime;
        $this->_doctor   = $doctor;
    }

    private function getDatetime()
    {
        return $this->_datetime;
    }

    private function getDoctor()
    {
        return $this->_doctor;
    }

    public function create( $data )
    {
        return $this->patientExists( $data )
            ? $this->_createWithExistsPatient($data)
            : $this->_createWithNewPatient($data);

    }

    private function patientExists( $data )
    {
        if ( empty($data['patientId']) ) {
            return false;
        }
        $patients = Patient::where('id', '=', $data['patientId']);

        return ( $patients->count() === 1 );
    }

    private function _createWithExistsPatient($data)
    {
        $this->_patient = Patient::find($data['patientId']);
        return $this->_createVisit($data);
    }

    private function _createWithNewPatient($data)
    {
        $phone      = $data['phone'];
        $firstname  = $data['firstname'];
        $lastname   = $data['lastname'];
        $patronymic = isset($data['patronymic']) ? $data['patronymic'] : '';

        if ( $this->createPatient($phone, $firstname, $lastname, $patronymic ) ) {
            return $this->_createVisit($data);
        }

        return false;
    }

    private function _createVisit($data)
    {
        $visit = new Visit();

        $visit->authorId   = Auth::id();
        $visit->note       = isset($data['note']) ? $data['note'] : '';
        $visit->date       = $this->getDatetime();
        $visit->doctorId   = $this->getDoctor()->id;
        $visit->categoryId = $data['categoryId'];
        $visit->patientId  = $this->getPatient()->id;

        $visit->save();

        return $visit->id;
    }

    private function createPatient($phone, $firstname, $lastname, $patronymic = null )
    {
        $patient = new Patient();

        $patient->authorId   = Auth::id();
        $patient->lastname   = $lastname;
        $patient->firstname  = $firstname;
        $patient->patronymic = $patronymic;
        $patient->phone      = $phone;
        $patient->categoryId = Patient::simplePatientCategory;

        $patient->save();

        $this->_patient = $patient;

        return true;
    }

    private function getPatient()
    {
        return $this->_patient;
    }
}