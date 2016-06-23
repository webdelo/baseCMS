<?php namespace App;

use Eloquent;
use App\User;

/**
 * Class Status
 *
 * @property \App\User                $author
 */
class Status extends Eloquent{

	/**
	 * @var array
	 */
	protected $guarded = ['id', 'author_id'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function author()
	{
		return $this->belongsTo(User::class, 'author_id');
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
		return $this->name;
	}

	public function getAlias()
	{
		return $this->alias;
	}

	public function getColor()
	{
		return $this->color;
	}
}
