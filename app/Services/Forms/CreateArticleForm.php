<?php namespace App\Services\Forms;

use Laracasts\Validation\FormValidator;

class CreateServiceForm extends FormValidator {

	protected $rules = [
		'id' => 'required|exists:services',
		'title' => 'required|unique:services',
		'slug' => 'required|unique:services|slug',
		'meta_description' => 'required|max:150',
		'text' => 'required',
	];

	protected $messages = [];

}
