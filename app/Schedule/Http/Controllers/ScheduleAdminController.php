<?php namespace App\Schedule\Http\Controllers;

use App\Doctors\Models\Doctor;
use App\Schedule\Models\Category;
use App\Schedule\ScheduleHandler;
use App\Schedule\ScheduleVisitCreator;
use App\Schedule\Views\Date as ScheduleDate;
use App\Time\Date;
use App\Time\Datetime;
use App\Time\FormatParser;
use App\Visits\Models\Category as VisitCategory;
use App\Schedule\Models\Schedule;
use App\Schedule\Models\Status;
use App\Noop;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use JildertMiedema\LaravelPlupload\Facades\Plupload;
use View;

class ScheduleAdminController extends BaseController
{
	protected $modelClassName = 'App\Schedule\Models\Schedule';

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
		return View::make('schedule.admin.show', [
			'date' => new Date(),
		]);
	}

	public function show($slug=null)
	{
		return View::make('schedule.calendar.day');
	}

	public function create()
	{
		$schedule        = new Noop();
		$visitCategories = new VisitCategory();

		return View::make('schedule.admin.create', [
			'schedule'        => $schedule,
			'visitCategories' => $visitCategories,

		]);
	}

	public function edit($id)
	{
		$schedule   = new Schedule();
		$schedule   = $schedule->findOrFail($id);
		$categories = new Category();
		$statuses   = new Status();

		return View::make('schedule.admin.edit', [
			'schedule'      => $schedule,
			'categories' => $categories,
			'statuses'   => $statuses,
		]);
	}

	public function destroy($id)
	{
		$schedule = new Schedule();
		$schedule  = $schedule->findOrFail($id);

		if ( ! $schedule->delete())
		{
			return response()->json(['result'=>false, 'error'=>"Something went wrong when deleting Schedule with ID {$id}"]);
		}

		return response()->json(true);
	}

	public function store()
	{
		$doctor   = Doctor::find( Input::get('doctorId') );
		$datetime = new Datetime( Input::get('date') );
		$creator  = new ScheduleVisitCreator( $doctor, $datetime );

		$id = $creator->create(Input::all());

		return response()->json($id);
	}

	public function update($id)
	{
		$schedule = new Schedule();
		$schedule = $schedule->findOrFail($id);

		$schedule->authorId   = Auth::id();
		$schedule->diagnosis  = Input::get('diagnosis');
		$schedule->treatment  = Input::get('treatment');
		$schedule->note       = Input::get('note');
		$schedule->address    = Input::get('address');
		$schedule->workFor    = Input::get('workFor');
		$schedule->categoryId = Input::get('categoryId');

		$schedule->save();

		return response()->json($schedule->id);
	}


	public function uploadImage()
	{
		return Plupload::receive('file', function ($file)
		{
			$schedule = new Schedule();
			$schedule = $schedule->findOrFail($_GET['objectId']);
			$imageHandler = new ScheduleImageHandler($schedule);
			if ( $imageHandler->add($file) ) {
				$schedule = $schedule->findOrFail($_GET['objectId']);
				return ['result' => 'ready', 'url'=>$schedule->image->getImage('640x480') ];
			} else
				return 'not ready';
		});
	}
}
