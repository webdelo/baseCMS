<?php namespace App\Services\Forms;

use Laracasts\Validation\FormValidator;

class ScheduleCreateNewVisitForm extends FormValidator {

	protected $rules = [
		'patientId'  => 'required|exists:patients',
		'doctorId'   => 'required|exists:doctors',
		'date'       => 'required',
		'categoryId' => 'required|exists:visits_categories',
	];

	protected $messages = [];

}
