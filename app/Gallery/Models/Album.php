<?php namespace App\Gallery\Models;

use App\Gallery\Models\Image;
use Eloquent;

/**
 * Class Gallery
 *
 */
class Album extends Eloquent implements \App\Interfaces\Imaginable
{

    public function getImagesTable()
    {
        return 'albums_images';
    }

    public function getFolder()
    {
        return '/data/images/gallery/';
    }

    public function getPath()
    {
        return '/images/gallery/';
    }

	/**
	 * @const string
	 */
	const PUBLISHED_AT = 'published_at';

	/**
	 * @var array
	 */
	protected $guarded = ['id', 'author_id'];

	/**
	 * @var array
	 */
	protected $dates = ['deleted_at', self::PUBLISHED_AT];

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

    /**
     * @return hasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class, 'objectId', 'id')->orderBy('priority', 'ASC');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function delete()
    {
        if ( $this->images->count() > 0 ) {
            $res = false;
            foreach ( $this->images as $image ) {
                $res = $image->remove();
            }
            if ( $res == false ) {
                return false;
            }
        }


        return parent::delete();
    }
}
