<?php namespace App\Gallery\Forms;

use Laracasts\Validation\FormValidator;

class UpdateGalleryForm extends FormValidator {

	protected $rules = [
		'title' => 'required',
		'slug' => 'required|regex:/^[A-Za-z0-9\-]+$/',
		'text' => 'required',
	];

	protected $messages = [];

}
