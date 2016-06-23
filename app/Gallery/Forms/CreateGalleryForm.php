<?php namespace App\Gallery\Forms;

use Laracasts\Validation\FormValidator;

class CreateGalleryForm extends FormValidator {

	protected $rules = [
		'id' => 'required|exists:Gallery',
		'title' => 'required|unique:Gallery',
		'slug' => 'required|unique:Gallery|slug',
		'meta_description' => 'required|max:150',
		'text' => 'required',
	];

	protected $messages = [];

}
