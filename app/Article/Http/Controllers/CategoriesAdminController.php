<?php namespace App\Article\Http\Controllers;
use App\Http\Controllers\BaseCategoriesAdminController;
use App\Article\Models\Category;
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
		return '/admin/articles';
	}
}
