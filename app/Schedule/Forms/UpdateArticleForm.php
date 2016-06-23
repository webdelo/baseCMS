<?php namespace App\Services\Forms;

use Laracasts\Validation\FormValidator;

class UpdateServiceForm extends FormValidator {

	protected $rules = [
		'title' => 'required',
		'slug' => 'required|regex:/^[A-Za-z0-9\-]+$/',
		'text' => 'required',
	];

	protected $messages = [];

}
