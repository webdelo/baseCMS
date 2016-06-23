<?php namespace App\Visits\Models;

use App\Interfaces\Imaginable;
use App\Patients\Models\Patient;
use App\Time\Datetime;
use Eloquent;
use App\User;

/**
 * Class Visit
 *
 * @property \App\User                $author
 */
class Visit extends Eloquent implements Imaginable {

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
	 * @return Datetime
	 */
	public function getDate()
	{
		return new Datetime($this->date);
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeWithAuthor($query)
	{
		return $query->with('author');
	}

	public function patient()
	{
		return $this->hasOne(Patient::class, 'id', 'patientId');
	}

	public function getAddress()
	{
		return $this->address ? $this->address : $this->patient->getAddress();
	}

	public function getWorkFor()
	{
		return $this->workFor ? $this->workFor : $this->patient->getWorkFor();
	}

	public function getDiagnosis()
	{
		return $this->diagnosis;
	}

	public function getTreatment()
	{
		return $this->treatment;
	}

	public function getNote()
	{
		return $this->note;
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
		return 'visits_images';
	}

	public function getFolder()
	{
		return '/data/images/visits/';
	}

	public function getPath()
	{
		return '/images/visits/';
	}
}