<?php namespace App\Visits\Http\Controllers;

use App\Visits\Models\Category;
use App\Visits\Models\Status;
use App\Visits\Models\VisitImageHandler;
use App\Visits\Models\VisitImageUploader;
use App\Noop;
use Illuminate\Routing\Controller as BaseController;
use App\Visits\Models\Visit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use JildertMiedema\LaravelPlupload\Facades\Plupload;
use View;

class VisitsAdminController extends BaseController
{
	protected $modelClassName = 'App\Visits\Models\Visit';

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
		$visits    = Visit::paginate(10);

		return View::make('visits.admin.list', [
			'visits'    => $visits
		]);
	}

	public function show($slug)
	{
		$visits    = new Visit();
		$visit     = $visits->find($slug);

		return View::make('visits.admin.show', [
			'visit'    => $visit
		]);
	}

	public function create()
	{
		$visit      = new Noop();
		$categories = new Category();
		$statuses   = new Status();

		return View::make('visits.admin.create', [
			'visit'      => $visit,
			'categories' => $categories,
			'statuses'   => $statuses
		]);
	}

	public function edit($id)
	{
		$visits     = new Visit();
		$visit      = $visits->findOrFail($id);
		$categories = new Category();
		$statuses   = new Status();

		return View::make('visits.admin.edit', [
			'visit'      => $visit,
			'categories' => $categories,
			'statuses'   => $statuses,
		]);
	}

	public function destroy($id)
	{
		$visits = new Visit();
		$visit  = $visits->findOrFail($id);

		if ( ! $visit->delete())
		{
			return response()->json(['result'=>false, 'error'=>"Something went wrong when deleting Visit with ID {$id}"]);
		}

		return response()->json(true);
	}

	public function store()
	{
		$visit     = new Visit();

		$visit->authorId   = Auth::id();
		$visit->diagnosis  = Input::get('diagnosis');
		$visit->treatment  = Input::get('treatment');
		$visit->note       = Input::get('note');
		$visit->address    = Input::get('address');
		$visit->workFor    = Input::get('workFor');
		$visit->categoryId = Input::get('categoryId');

		$visit->save();

		return response()->json($visit->id);
	}

	public function update($id)
	{
		$visits = new Visit();
		$visit = $visits->findOrFail($id);

		$visit->authorId   = Auth::id();
		$visit->diagnosis  = Input::get('diagnosis');
		$visit->treatment  = Input::get('treatment');
		$visit->note       = Input::get('note');
		$visit->address    = Input::get('address');
		$visit->workFor    = Input::get('workFor');
		$visit->categoryId = Input::get('categoryId');

		$visit->save();

		return response()->json($visit->id);
	}


	public function uploadImage()
	{
		return Plupload::receive('file', function ($file)
		{
			$visits = new Visit();
			$visit = $visits->findOrFail($_GET['objectId']);
			$imageHandler = new VisitImageHandler($visit);
			if ( $imageHandler->add($file) ) {
				$visit = $visits->findOrFail($_GET['objectId']);
				return ['result' => 'ready', 'url'=>$visit->image->getImage('640x480') ];
			} else
				return 'not ready';
		});
	}
}
