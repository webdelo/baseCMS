<?php namespace App\Patients\Models;

use App\Interfaces\Imaginable;
use Eloquent;
use App\User;

/**
 * Class Patient
 *
 * @property \App\User                $author
 */
class Patient extends Eloquent implements Imaginable {

	const simplePatientCategory = 1;

	/**
	 * @var array
	 */
	protected $guarded = ['id', 'author_id'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function author()
	{
		return $this->belongsTo(User::class, 'authorId');
	}

    /**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo(Category::class, 'categoryId');
	}

    /**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function status()
	{
		return $this->belongsTo(Status::class, 'statusId');
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeWithAuthor($query)
	{
		return $query->with('author');
	}

	public function getName()
	{
		return $this->getLastname().' '.$this->getFirstname().' '.$this->getPatronymic();
	}

	public function getFirstname()
	{
		return $this->firstname;
	}

	public function getLastname()
	{
		return $this->lastname;
	}

	public function getPatronymic()
	{
		return $this->patronymic;
	}

	public function getPhone()
	{
		return $this->phone;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function getWorkFor()
	{
		return $this->workFor;
	}

	public function isMale()
	{
		return ($this->male);
	}

	public function getNote()
	{
		return $this->note;
	}

	public function getBirthdate()
	{
		return substr($this->birthdate, 0, 10);
	}

	public function getAvatar( $size = null )
	{
		$no_avatar = $this->isMale()?'male.jpg':'female.jpg';
		$image = $this->image
			? $this->image->getImage($size)
			: '/data/images/employees/no_avatar_'.$no_avatar;

		return $image;
	}

	public function image()
	{
		return $this->hasOne(Image::class, 'objectId', 'id');
	}

	public function getImagesTable()
	{
		return 'patients_images';
	}

	public function getFolder()
	{
		return '/data/images/patients/';
	}

	public function getPath()
	{
		return '/images/patients/';
	}
}
