<?php namespace App\Services\Repositories;

use App\Services\Models\Service;

class ServiceRepo extends AbstractRepository {

	public function __construct(Service $Service)
	{
		$this->model = $Service;
	}

	/**
	 * ID автора поста
	 *
	 * @param int $Service_id
	 * @return int
	 */
	public function getAuthorId($Service_id)
	{
		$author_id = $this->model->where('id', $Service_id)->pluck('author_id');

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
		$Service = $this->model->where('slug', $slug)->with('author')->withComments()->firstOrFail();

		return $Service;
	}

	/**
	 * Последние посты
	 *
	 * @param int $num
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function getLastServices($num = 10)
	{
		return $this->model->notDraft()->withAuthor()->orderByDatePublished()->limit($num)->get();
	}

	/**
	 * Get the latest services and paginate them
	 *
	 * @param int $num
	 * @return mixed
	 */
	public function getServicesAndPaginate($num = 15)
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
