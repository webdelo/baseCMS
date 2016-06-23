<?php namespace App\Gallery\Repositories;

use App\Gallery\Models\Gallery;

class GalleryRepo extends AbstractRepository {

	public function __construct(Gallery $Gallery)
	{
		$this->model = $Gallery;
	}

	/**
	 * ID автора поста
	 *
	 * @param int $Gallery_id
	 * @return int
	 */
	public function getAuthorId($Gallery_id)
	{
		$author_id = $this->model->where('id', $Gallery_id)->pluck('author_id');

		return $author_id;
	}

	/**
	 * Получить пост по урлу
	 *
	 * @param $slug
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function getBySlug($slug)
	{
		$Gallery = $this->model->where('slug', $slug)->with('author')->withComments()->firstOrFail();

		return $Gallery;
	}

	/**
	 * Последние посты
	 *
	 * @param int $num
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function getLastGallery($num = 10)
	{
		return $this->model->notDraft()->withAuthor()->orderByDatePublished()->limit($num)->get();
	}

	/**
	 * Get the latest Gallery and paginate them
	 *
	 * @param int $num
	 * @return mixed
	 */
	public function getGalleryAndPaginate($num = 15)
	{
		return $this->model->notDraft()->withAuthor()->withComments()->orderByDatePublished()->paginate($num);
	}

	/**
	 * html-селектор выбора версии фрейворка в посте
	 */
	public function getFrameworkVersionSelect($currentFrameworkVersion)
	{
		$allVersions = Version::all();
	}

}
