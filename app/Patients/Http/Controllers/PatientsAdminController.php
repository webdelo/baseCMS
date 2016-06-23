<?php namespace App\Patients\Http\Controllers;

use App\Patients\Models\Category;
use App\Patients\Models\PatientImageHandler;
use App\Patients\Models\PatientImageUploader;
use App\Patients\Models\PatientsCategories;
use App\Patients\Models\Position;
use App\Patients\Models\Speciality;
use App\Noop;
use App\Patients\Models\Status;
use Illuminate\Routing\Controller as BaseController;
use App\Patients\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use JildertMiedema\LaravelPlupload\Facades\Plupload;
use View;

class PatientsAdminController extends BaseController
{
	protected $modelClassName = 'App\Patients\Models\Patient';

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
		$patients    = Patient::paginate(10);

		return View::make('patients.admin.list', [
			'patients'    => $patients
		]);
	}

	public function show($slug)
	{
		$patients    = new Patient();
		$patient     = $patients->find($slug);

		return View::make('patients.admin.show', [
			'patient'    => $patient
		]);
	}

	public function create()
	{
		$patient    = new Noop();
		$categories = new Category();
		$statuses   = new Status();

		return View::make('patients.admin.create', [
			'patient'    => $patient,
			'categories' => $categories,
			'statuses'   => $statuses
		]);
	}

	public function edit($id)
	{
		$patients   = new Patient();
		$patient    = $patients->findOrFail($id);
		$categories = new Category();
		$statuses   = new Status();

		return View::make('patients.admin.edit', [
			'patient'    => $patient,
			'categories' => $categories,
			'statuses'   => $statuses
		]);
	}

	public function destroy($id)
	{
		$patients = new Patient();
		$patient  = $patients->findOrFail($id);

		if ( ! $patient->delete())
		{
			return response()->json(['result'=>false, 'error'=>"Something went wrong when deleting Patient with ID {$id}"]);
		}

		return response()->json(true);
	}

	public function store()
	{
		$patient     = new Patient();

		$patient->authorId   = Auth::id();
		$patient->lastname   = Input::get('lastname');
		$patient->firstname  = Input::get('firstname');
		$patient->patronymic = Input::get('patronymic');
		$patient->male       = Input::get('male');
		$patient->note       = Input::get('note');
		$patient->address    = Input::get('address');
		$patient->phone      = Input::get('phone');
		$patient->email      = Input::get('email');
		$patient->workFor    = Input::get('workFor');
		$patient->birthdate  = Input::get('birthdate');
		$patient->categoryId = Input::get('categoryId');

		$patient->save();

		return response()->json($patient->id);
	}

	public function update($id)
	{
		$patients = new Patient();
		$patient = $patients->findOrFail($id);

		$patient->authorId   = Auth::id();
		$patient->lastname   = Input::get('lastname');
		$patient->firstname  = Input::get('firstname');
		$patient->patronymic = Input::get('patronymic');
		$patient->phone      = Input::get('phone');
		$patient->email      = Input::get('email');
		$patient->male       = Input::get('male');
		$patient->note       = Input::get('note');
		$patient->address    = Input::get('address');
		$patient->workFor    = Input::get('workFor');
		$patient->birthdate  = Input::get('birthdate');
		$patient->categoryId = Input::get('categoryId');

		$patient->save();

		return response()->json($patient->id);
	}


	public function uploadImage()
	{
		return Plupload::receive('file', function ($file)
		{
			$patients = new Patient();
			$patient = $patients->findOrFail($_GET['objectId']);
			$imageHandler = new PatientImageHandler($patient);
			if ( $imageHandler->add($file) ) {
				$patient = $patients->findOrFail($_GET['objectId']);
				return ['result' => 'ready', 'url'=>$patient->image->getImage('640x480') ];
			} else
				return 'not ready';
		});
	}
}
