<?php namespace App\Article\Models;

use App\Interfaces\Metable;
use App\Noop;
use App\User;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Gallery
 *
 */
class Article extends Model implements Metable
{
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
		return $this->belongsTo(User::class, 'author_id', 'id');
	}

    /**
     * @return mixed
     */
    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'statusId');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'categoryId');
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
    public function getH1()
    {
        return $this->h1;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    public function nextArticle()
    {
        return Article::where('id', '>', $this->id)
            ->orderBy('id', 'ASC')
            ->first();
    }

    public function prevArticle()
    {
        return Article::where('id', '<', $this->id)
            ->orderBy('id', 'ASC')
            ->first();
    }
}
