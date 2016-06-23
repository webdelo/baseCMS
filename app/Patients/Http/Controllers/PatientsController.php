<?php namespace App\Patients\Http\Controllers;

use App\Patients\Models\PatientsCategories;
use Illuminate\Routing\Controller as BaseController;
use App\Patients\Models\Patient;
use View;


class PatientsController extends BaseController {

	public function showAll()
	{
        $patients = Patient::all();
        $categories = new PatientsCategories();

		return View::make('patients.list', [ 'patients'=>$patients, 'categories'=>$categories->getCategories()  ]);
	}

	public function show($slug)
	{
		$patient = $this->patientRepo->getBySlug($slug);

		return View::make('patients.show', compact('patient'));
	}

	public function create()
	{
        $patient = new Patient();
        $patient->authorId = Auth::id();
        $patient->save();

		return View::make('patients.create', compact('patient', 'difficultyLevels'));
	}

	public function edit($id)
	{
		$this->access->checkEditPatient($id);
		$post = $this->postRepo->findOrFail($id);

		return View::make('patients.edit', compact('post'));
	}

	public function store()
	{
//		$data = Input::all();
//
//		$this->createPatientForm->validate($data);
//
//		// TODO remove everything not needed in the text field
//
//		$patient = Patient::find($data['id'])->first();
//
//		$this->access->checkEditPatient($patient);
//
//		$patient->fill($data);
//
//		if ($patient->is_draft == 0 && is_null($patient->published_at))
//		{
//			$patient->published_at = Carbon::now();
//		}
//
//		$patient->save();
//
//		return Redirect::route('user.profile')->with('success', 'Статья сохранена сохранен');
	}

}