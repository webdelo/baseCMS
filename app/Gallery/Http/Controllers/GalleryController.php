<?php namespace App\Gallery\Http\Controllers;

use App\Gallery\Models\Album;
use App\Gallery\Models\ImageRow;
use App\Views\GalleryView;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use App\Gallery\Models\Gallery;
use View;


class GalleryController extends BaseController {

	public function showAll()
	{
		$albums = new Album();
		$view = new GalleryView();

		return $view->setContent('albums', $albums->where('statusId', '=', 1)->get())->render();
	}

    public function showJson()
    {
        return response()->json(Album::with('images')->get()->toArray());
    }

    public function getImage($resize, $id)
    {
        $image = ImageRow::find($id);
        $x = explode('x', $resize)[0];
        $y = explode('x', $resize)[1];

        return $image->getImage($x, $y);
    }

	public function show($slug)
	{
		return View::make('gallery.show', compact('Gallery'));
	}

	public function create()
	{
        $Gallery = new Gallery();
        $Gallery->author_id = Auth::id();
        $Gallery->save();

		return View::make('gallery.create', compact('Gallery', 'difficultyLevels'));
	}

	public function edit($id)
	{
		$this->access->checkEditGallery($id);
		$post = $this->postRepo->findOrFail($id);

		return View::make('gallery.edit', compact('post'));
	}

	public function store()
	{
//		$data = Input::all();
//
//		$this->createGalleryForm->validate($data);
//
//		// TODO remove everything not needed in the text field
//
//		$Gallery = Gallery::find($data['id'])->first();
//
//		$this->access->checkEditGallery($Gallery);
//
//		$Gallery->fill($data);
//
//		if ($Gallery->is_draft == 0 && is_null($Gallery->published_at))
//		{
//			$Gallery->published_at = Carbon::now();
//		}
//
//		$Gallery->save();
//
//		return Redirect::route('user.profile')->with('success', 'Статья сохранена сохранен');
	}

}