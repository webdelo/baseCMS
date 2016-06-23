<?php namespace App\Http\Controllers;

use App\Noop;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use View;

abstract class BaseCategoriesAdminController extends BaseController
{
	abstract protected function getModel();
	abstract protected function getUrlRoot();

	protected function getTplRoot()
	{
		return 'admin.categories';
	}

	public function __construct()
	{
	}

	public function index()
	{
		return $this->showAll();
	}

	public function showAll()
	{

		$categories = $this->getModel();

		return View::make($this->getTplRoot().'.list', [
			'categories' => $categories,
			'urlRoot'    => $this->getUrlRoot()
		]);
	}

	public function show($slug)
	{
		$categories    = $this->getModel();
		$category     = $categories->find($slug);

		return View::make($this->getTplRoot().'.show', [
			'category' => $category,
			'urlRoot'  => $this->getUrlRoot()
		]);
	}

	public function create()
	{
		$category     = new Noop();
		$categories   = $this->getModel();

		return View::make($this->getTplRoot().'.create', [
			'category'   => $category,
			'categories' => $categories,
			'urlRoot'    => $this->getUrlRoot()
		]);
	}

	public function edit($id)
	{
		$categories = $this->getModel();
		$category   = $categories->findOrFail($id);

		return View::make($this->getTplRoot().'.edit', [
			'category'   => $category,
			'categories' => $categories,
			'urlRoot'    => $this->getUrlRoot()
		]);
	}

	public function destroy($id)
	{
		$categories = $this->getModel();
		$category = $categories->findOrFail($id);

		if ( ! $category->delete())
		{
			return response()->json(['result'=>false, 'error'=>"Something went wrong when deleting Service category with ID {$id}"]);
		}

		return response()->json(true);
	}

	public function store()
	{
		$category     = $this->getModel();

		$category->authorId    = Auth::id();
		$category->name        = Input::get('name');
		$category->description = Input::get('description');
		$category->alias       = Input::get('alias');
		$category->parentId    = Input::get('parentId');

		$category->save();

		return response()->json($category->id);
	}

	public function update($id)
	{
		$categories = $this->getModel();
		$category   = $categories->findOrFail($id);

		$category->authorId    = Auth::id();
		$category->name        = Input::get('name');
		$category->description = Input::get('description');
		$category->alias       = Input::get('alias');
		$category->parentId    = Input::get('parentId');

		$category->save();

		return response()->json($category->id);
	}
}
