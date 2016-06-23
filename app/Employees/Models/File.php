<?php namespace App\Employees\Models;

use Eloquent;
use App\User;
use Illuminate\Support\Facades\DB;

/**
 * Class Status
 *
 * @property \App\User                $author
 */
class File extends Eloquent{

    /**
     * @var string
     */
    protected $table = 'employees_files';
	/**
	 * @var array
	 */
	protected $guarded = ['id', 'author_id'];
    /**
     * @var array
     */
    protected $subCategoriesArray = [];

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
}
