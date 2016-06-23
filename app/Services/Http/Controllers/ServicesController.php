<?php namespace App\Services\Http\Controllers;

use App\Services\Models\ServicesCategories;
use App\Views\ServicesView;
use Illuminate\Routing\Controller as BaseController;
use App\Services\Models\Service;
use View;


class ServicesController extends BaseController {

	public function showAll()
	{
        $services   = Service::all();
        $categories = new ServicesCategories();

		$view = new ServicesView();
		$view->setContents([
			'services'   =>$services,
			'categories' => $categories->getCategories()
		]);

		return $view->render();
	}

	public function show($slug)
	{
		$service = $this->serviceRepo->getBySlug($slug);

		return View::make('services.show', compact('service'));
	}

	public function create()
	{
        $service = new Service();
        $service->authorId = Auth::id();
        $service->save();

		return View::make('services.create', compact('service', 'difficultyLevels'));
	}

	public function edit($id)
	{
		$this->access->checkEditService($id);
		$post = $this->postRepo->findOrFail($id);

		return View::make('services.edit', compact('post'));
	}

	public function store()
	{
//		$data = Input::all();
//
//		$this->createServiceForm->validate($data);
//
//		// TODO remove everything not needed in the text field
//
//		$service = Service::find($data['id'])->first();
//
//		$this->access->checkEditService($service);
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