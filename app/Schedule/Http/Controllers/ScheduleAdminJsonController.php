<?php namespace App\Schedule\Http\Controllers;

use App\Doctors\Models\Doctor;
use App\Patients\Models\Patient;
use App\Schedule\Models\Category;
use App\Schedule\ScheduleHandler;
use App\Schedule\ScheduleVisitCreator;
use App\Schedule\Views\Date as ScheduleDate;
use App\Patients\Repositories\PatientRepo;
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

class ScheduleAdminJsonController extends BaseController
{
	public function __construct()
	{
//		$this->middleware('guest');
	}

	public function doctors()
	{
		$doctors = Doctor::with('employee', 'category', 'status')->get();


		return response()->json($doctors);
	}

	public function patients()
	{
		if ( !Input::get('phone') && Input::get('firstname') && !Input::get('lastname') && !Input::get('patronymic') ) {
			return response()->json([]);
		}

		$patients = Patient::with('category', 'status');
		$repo = new PatientRepo($patients);


		if ( Input::get('phone') ) {
			$patients = $repo->getByPhone( Input::get('phone') );
		}
		if ( Input::get('firstname') ) {
			$patients = $repo->getByFirstname( Input::get('firstname') );
		}
		if ( Input::get('lastname') ) {
			$patients = $repo->getByLastname( Input::get('lastname') );
		}
		if ( Input::get('patronymic') ) {
			$patients = $repo->getByPatronymic( Input::get('patronymic') );
		}

		return response()->json($patients->get());
	}

	public function date($slug)
	{
		$parser   = new FormatParser('d-m-Y', $slug);
		$appDate  = new Date((int)$parser->getDay(), (int)$parser->getMonth(), (int)$parser->getYear());

		$dateView = new ScheduleDate($appDate);

		return response()->json($dateView);
	}

	public function today()
	{
		$dateView = new ScheduleDate(new Date());

		return response()->json($dateView);
	}
}
