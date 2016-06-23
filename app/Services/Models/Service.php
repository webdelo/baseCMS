<?php namespace App\Services\Models;

use Eloquent;
use App\User;

/**
 * Class Service
 *
 * @property \App\User                $author
 */
class Service extends Eloquent {

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
	public function measurement()
	{
		return $this->belongsTo(Measurement::class, 'measurementId');
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

    /**
	 * @param $query
	 * @return mixed
	 */
	public function scopeWithMeasurement($query)
	{
		return $query->with('measurement');
	}

	/**
	 * @param        $query
	 * @param string $sortOrder
	 * @return mixed
	 */
	public function scopeOrderByDatePublished($query, $sortOrder = 'desc')
	{
		return $query->orderBy(self::PUBLISHED_AT, $sortOrder);
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function getMeasure()
	{
		return $this->measure;
	}
}
