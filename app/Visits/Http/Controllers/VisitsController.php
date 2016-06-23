<?php namespace App\Visits\Http\Controllers;

use App\Visits\Models\VisitsCategories;
use Illuminate\Routing\Controller as BaseController;
use App\Visits\Models\Visit;
use View;


class VisitsController extends BaseController {

	public function showAll()
	{
        $patients = Visit::all();
        $categories = new VisitsCategories();

		return View::make('patients.list', [ 'patients'=>$patients, 'categories'=>$categories->getCategories()  ]);
	}

	public function show($slug)
	{
		$patient = $this->patientRepo->getBySlug($slug);

		return View::make('patients.show', compact('patient'));
	}

	public function create()
	{
        $patient = new Visit();
        $patient->authorId = Auth::id();
        $patient->save();

		return View::make('patients.create', compact('patient', 'difficultyLevels'));
	}

	public function edit($id)
	{
		$this->access->checkEditVisit($id);
		$post = $this->postRepo->findOrFail($id);

		return View::make('patients.edit', compact('post'));
	}

	public function store()
	{
//		$data = Input::all();
//
//		$this->createVisitForm->validate($data);
//
//		// TODO remove everything not needed in the text field
//
//		$patient = Visit::find($data['id'])->first();
//
//		$this->access->checkEditVisit($patient);
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