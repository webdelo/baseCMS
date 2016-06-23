<?php namespace App\Employees\Http\Controllers;

use App\Employees\Models\EmployeesCategories;
use App\Views\EmployeesView;
use Illuminate\Routing\Controller as BaseController;
use App\Employees\Models\Employee;
use View;


class EmployeesController extends BaseController {

	public function showAll()
	{
        $categories = new EmployeesCategories();
		$view = new EmployeesView();

		return $view->setContent('categories', $categories->getCategories())->render();
	}

	public function show($slug)
	{
		$service = $this->serviceRepo->getBySlug($slug);

		return View::make('services.show', compact('service'));
	}

	public function create()
	{
        $service = new Employee();
        $service->authorId = Auth::id();
        $service->save();

		return View::make('services.create', compact('service', 'difficultyLevels'));
	}

	public function edit($id)
	{
		$this->access->checkEditEmployee($id);
		$post = $this->postRepo->findOrFail($id);

		return View::make('services.edit', compact('post'));
	}

	public function store()
	{
//		$data = Input::all();
//
//		$this->createEmployeeForm->validate($data);
//
//		// TODO remove everything not needed in the text field
//
//		$service = Employee::find($data['id'])->first();
//
//		$this->access->checkEditEmployee($service);
//
//		$service->fill($data);
//
//		if ($service->is_draft == 0 && is_null($service->published_at))
//		{
//			$service->published_at = Carbon::now();
//		}
//
//		$service->save();
//
//		return Redirect::route('user.profile')->with('success', 'Статья сохранена сохранен');
	}

}