<?php namespace App\Employees\Repositories;

use App\Employees\Models\Employee;

class EmployeeRepo extends AbstractRepository {

	public function __construct(Employee $Employee)
	{
		$this->model = $Employee;
	}

	/**
	 * ID автора поста
	 *
	 * @param int $Employee_id
	 * @return int
	 */
	public function getAuthorId($Employee_id)
	{
		$author_id = $this->model->where('id', $Employee_id)->pluck('author_id');

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
		$Employee = $this->model->where('slug', $slug)->with('author')->withComments()->firstOrFail();

		return $Employee;
	}

	/**
	 * Последние посты
	 *
	 * @param int $num
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function getLastEmployees($num = 10)
	{
		return $this->model->notDraft()->withAuthor()->orderByDatePublished()->limit($num)->get();
	}

	/**
	 * Get the latest services and paginate them
	 *
	 * @param int $num
	 * @return mixed
	 */
	public function getEmployeesAndPaginate($num = 15)
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
