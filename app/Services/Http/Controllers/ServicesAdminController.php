<?php namespace App\Services\Http\Controllers;

use App\Services\Models\Category;
use App\Services\Models\Measurement;
use App\Services\Models\ServiceImageHandler;
use App\Services\Models\ServiceImageUploader;
use App\Services\Models\ServicesCategories;
use App\Services\Models\Position;
use App\Services\Models\Speciality;
use App\Noop;
use Illuminate\Routing\Controller as BaseController;
use App\Services\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use JildertMiedema\LaravelPlupload\Facades\Plupload;
use View;

class ServicesAdminController extends BaseController
{
	protected $modelClassName = 'App\Services\Models\Service';

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
		$services    = Service::paginate(10);


		return View::make('services.admin.list', [
			'services'    => $services
		]);
	}

	public function show($slug)
	{
		$services    = new Service();
		$service     = $services->find($slug);

		return View::make('services.admin.show', [
			'service'    => $service
		]);
	}

	public function create()
	{
		$service      = new Noop();
		$measurements = new Measurement();
		$categories   = new Category();

		return View::make('services.admin.create', [
			'service'      => $service,
			'measurements' => $measurements,
			'categories'   => $categories
		]);
	}

	public function edit($id)
	{
		$services     = new Service();
		$service      = $services->findOrFail($id);
		$categories   = new Category();
		$measurements = new Measurement();

		return View::make('services.admin.edit', [
			'service'      => $service,
			'measurements' => $measurements,
			'categories'   => $categories
		]);
	}

	public function destroy($id)
	{
		$services = new Service();
		$service  = $services->findOrFail($id);

		if ( ! $service->delete())
		{
			return response()->json(['result'=>false, 'error'=>"Something went wrong when deleting Service with ID {$id}"]);
		}

		return response()->json(true);
	}

	public function store()
	{
		$service     = new Service();

		$service->authorId      = Auth::id();
		$service->name          = Input::get('name');
		$service->description   = Input::get('description');
		$service->price         = Input::get('price');
		$service->measure       = Input::get('measure');
		$service->measurementId = Input::get('measurementId');
		$service->statusId      = 1;
		$service->categoryId    = Input::get('categoryId');

		$service->save();


		return response()->json($service->id);
	}

	public function update($id)
	{
		$services = new Service();
		$service = $services->findOrFail($id);

		$service->authorId      = Auth::id();
		$service->name          = Input::get('name');
		$service->description   = Input::get('description');
		$service->price         = Input::get('price');
		$service->measure       = Input::get('measure');
		$service->measurementId = Input::get('measurementId');
		$service->statusId      = 1;
		$service->categoryId    = Input::get('categoryId');

		$service->save();

		return response()->json($service->id);
	}
}
