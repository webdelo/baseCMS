<?php namespace App\Patients\Repositories;

use App\Core\Repositories\AbstractRepository;
use App\Patients\Models\Patient;

class PatientRepo extends AbstractRepository
{

	public function __construct($patient)
	{
		$this->model = $patient;
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
		$Service = $this->model->where('slug', $slug)->with('author')->firstOrFail();

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


	public function getByPhone($phone)
	{
		$patients = $this->model->with('category', 'status');

		$phone = ltrim($phone, "0");
		$phone = ltrim($phone, "+373");
		$phone = ltrim($phone, " ");
		$patients->where('phone', 'LIKE', '%'.$phone.'%' );

		return $patients;
	}

	public function getByFirstname( $firstname )
	{
		$patients = $this->model->with('category', 'status')->where('firstname', 'LIKE', $firstname.'%' );

		return $patients;
	}

	public function getByLastname( $lastname )
	{
		$patients = $this->model->with('category', 'status')->where('lastname', 'LIKE', $lastname.'%' );

		return $patients;
	}

	public function getByPatronymic( $patronymic )
	{
		$patients = $this->model->with('category', 'status')->where('patronymic', 'LIKE', $patronymic.'%' );

		return $patients;
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
