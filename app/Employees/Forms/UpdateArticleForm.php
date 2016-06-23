<?php namespace App\Employees\Forms;

use Laracasts\Validation\FormValidator;

class UpdateEmployeeForm extends FormValidator {

	protected $rules = [
		'title' => 'required',
		'slug' => 'required|regex:/^[A-Za-z0-9\-]+$/',
		'text' => 'required',
	];

	protected $messages = [];

}
