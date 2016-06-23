<?php namespace App\Employees\Http\Controllers;

use App\Employees\Models\Category;
use App\Employees\Models\EmployeeImageHandler;
use App\Employees\Models\EmployeeImageUploader;
use App\Employees\Models\EmployeesCategories;
use App\Employees\Models\Position;
use App\Employees\Models\Speciality;
use App\Noop;
use Illuminate\Routing\Controller as BaseController;
use App\Employees\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use JildertMiedema\LaravelPlupload\Facades\Plupload;
use View;

class EmployeesAdminController extends BaseController
{
	protected $modelClassName = 'App\Employees\Models\Employee';

	public function __construct()
	{
//		$this->middleware('guest');
	}

	public function index()
	{
		return $this->showAll();
	}

	public function showAll()
	{
		$employees    = Employee::paginate(10);
		$positions    = new Position();
		$specialities = new Speciality();

		return View::make('employees.admin.list', [
			'employees'    => $employees,
			'positions'    => $positions,
			'specialities' => $specialities
		]);
	}

	public function show($slug)
	{
		$employees    = new Employee();
		$employee     = $employees->find($slug);
		$positions    = new Position();
		$specialities = new Speciality();

		return View::make('employees.admin.show', [
			'employee'    => $employee,
			'positions'    => $positions,
			'specialities' => $specialities
		]);
	}

	public function create()
	{
		$employee     = new Noop();
		$positions    = new Position();
		$specialities = new Speciality();
		$categories   = new Category();

		return View::make('employees.admin.create', [
			'employee'     => $employee,
			'positions'    => $positions,
			'specialities' => $specialities,
			'categories'   => $categories
		]);
	}

	public function edit($id)
	{
		$employees = new Employee();
		$employee = $employees->findOrFail($id);
		$positions    = new Position();
		$specialities = new Speciality();
		$categories   = new Category();

		return View::make('employees.admin.edit', [
			'employee'     => $employee,
			'positions'    => $positions,
			'specialities' => $specialities,
			'categories'   => $categories
		]);
	}

	public function destroy($id)
	{
		$employees = new Employee();
		$employee  = $employees->findOrFail($id);

		if ( ! $employee->delete())
		{
			return response()->json(['result'=>false, 'error'=>"Something went wrong when deleting Employee with ID {$id}"]);
		}

		return response()->json(true);
	}

	public function store()
	{
		$employee     = new Employee();

		$employee->authorId   = Auth::id();
		$employee->lastname   = Input::get('lastname');
		$employee->firstname  = Input::get('firstname');
		$employee->patronymic = Input::get('patronymic');
		$employee->positionId = Input::get('positionId');
		$employee->categoryId = Input::get('categoryId');
		$employee->male       = Input::get('male');
		$employee->save();
		if ( Input::get('speciality') ) {
			$employee->specialities()->sync(Input::get('speciality'));
		}

		return response()->json($employee->id);
	}

	public function update($id)
	{
		$employees = new Employee();
		$employee = $employees->findOrFail($id);

		$employee->lastname   = Input::get('lastname');
		$employee->firstname  = Input::get('firstname');
		$employee->patronymic = Input::get('patronymic');
		$employee->positionId = Input::get('positionId');
		$employee->categoryId = Input::get('categoryId');
		$employee->male       = Input::get('male');

		if ( Input::get('speciality') ) {
			$employee->specialities()->sync(Input::get('speciality'));
		}

		$employee->save();

		return response()->json($employee->id);
	}


	public function uploadImage()
	{
		return Plupload::receive('file', function ($file)
		{
			$employees = new Employee();
			$employee = $employees->findOrFail($_GET['objectId']);
			$imageHandler = new EmployeeImageHandler($employee);
			if ( $imageHandler->add($file) ) {
				$employee = $employees->findOrFail($_GET['objectId']);
				return ['result' => 'ready', 'url'=>$employee->image->getImage('640x480') ];
			} else
				return 'not ready';
		});
	}
}
