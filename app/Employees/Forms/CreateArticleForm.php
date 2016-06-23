<?php namespace App\Employees\Forms;

use Laracasts\Validation\FormValidator;

class CreateEmployeeForm extends FormValidator {

	protected $rules = [
		'id' => 'required|exists:services',
		'title' => 'required|unique:services',
		'slug' => 'required|unique:services|slug',
		'meta_description' => 'required|max:150',
		'text' => 'required',
	];

	protected $messages = [];

}
