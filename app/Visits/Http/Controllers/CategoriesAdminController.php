<?php namespace App\Visits\Http\Controllers;
use App\Http\Controllers\BaseCategoriesAdminController;
use App\Visits\Models\Category;
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
		return '/admin/visits';
	}
}
