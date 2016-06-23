<?php namespace App\Article\Http\Controllers;

use App\Article\Models\Article;
use Illuminate\Routing\Controller as BaseController;
use View;


class ArticleController extends BaseController {

	public function show($slug)
	{
		$articles = new Article();
		$article  = $articles->find($slug);

		return View::make('articles.show', [ 'article' => $article ]);
	}

}