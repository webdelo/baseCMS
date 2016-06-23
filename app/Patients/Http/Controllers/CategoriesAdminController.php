<?php namespace App\Patients\Http\Controllers;
use App\Http\Controllers\BaseCategoriesAdminController;
use App\Patients\Models\Category;
use View;

class CategoriesAdminController extends BaseCategoriesAdminController
{
	public function __construct()
	{
//		$this->middleware('guest');
	}

	protected function getModel()
	{
		return new Category();
	}

	protected function getUrlRoot()
	{
		return '/admin/patients';
	}
}
