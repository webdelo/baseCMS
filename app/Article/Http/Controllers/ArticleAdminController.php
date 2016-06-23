<?php namespace App\Article\Http\Controllers;

use App\Article\Models\Article;
use App\Article\Models\Category;
use App\Article\Models\Status;
use App\Noop;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class ArticleAdminController extends BaseController
{
	protected $modelClassName = 'App\Article\Models\Article';

    public function __construct()
    {
		$this->middleware('auth');
    }

	public function index()
	{
		return $this->showAll();
	}

	public function showAll()
	{
		$articles = Article::paginate(10);

		return View::make('articles.admin.list', [ 'articles' => $articles ]);
	}

	public function destroy($id)
	{
        $articles = new Article();
        $article  = $articles->findOrFail($id);

        if ( ! $article->delete())
        {
            return response()->json(['result'=>false, 'error'=>"Something went wrong when deleting Article with ID {$id}"]);
        }

        return response()->json(true);
	}

	public function create()
	{
		return View::make('articles.admin.create', [
			'article'    => new Noop(),
			'categories' => new Category(),
			'statuses'   => new Status()
		]);
	}

	public function store( )
	{
		$article     = new Article();

		$article->authorId        = Auth::id();
		$article->name            = Input::get('name');
		$article->alias           = Input::get('alias');
		$article->h1              = Input::get('h1');
		$article->description     = Input::get('description');
		$article->text            = Input::get('text');
		$article->statusId        = Input::get('statusId');
		$article->categoryId      = Input::get('categoryId');
		$article->metaTitle       = Input::get('metaTitle');
		$article->metaKeywords    = Input::get('metaKeywords');
		$article->metaDescription = Input::get('metaDesscription');
		$article->save();

		return response()->json($article->id);
	}

	public function edit($id)
	{
		$articles = new Article();
		$article = $articles->findOrFail($id);

		return View::make('articles.admin.edit', [
			'article'    => $article,
			'categories' => new Category(),
			'statuses'   => new Status()
		]);
	}

	public function update($id)
	{
        $articles = new Article();
        $article = $articles->findOrFail($id);

		$article->authorId        = Auth::id();
		$article->name            = Input::get('name');
		$article->alias           = Input::get('alias');
		$article->h1              = Input::get('h1');
		$article->description     = Input::get('description');
		$article->text            = Input::get('text');
		$article->statusId        = Input::get('statusId');
		$article->categoryId      = Input::get('categoryId');
		$article->metaTitle       = Input::get('metaTitle');
		$article->metaKeywords    = Input::get('metaKeywords');
		$article->metaDescription = Input::get('metaDescription');
        $article->save();

        return response()->json($article->id);
	}
}