<?php namespace App\Employees\Http\Controllers;
use App\Employees\Models\Category;
use App\Http\Controllers\BaseCategoriesAdminController;
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
		return '/admin/employees';
	}
}
