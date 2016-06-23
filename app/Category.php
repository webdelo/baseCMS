<?php namespace App;

use Eloquent;
use App\User;
use Illuminate\Support\Facades\DB;

/**
 * Class Status
 *
 * @property \App\User                $author
 */
class Category extends Eloquent{

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

    /**
     * @return Categories
     */
    public function subCategories()
    {
        return $this->hasMany(get_class($this), 'parentId', 'id')->where('statusId','=',1);
    }

    /**
     * @return array
     */
    public function subCategoriesArray()
    {
        if ( !$this->subCategoriesArray ) {
            foreach( $this->subCategories as $category ) {
                array_push($this->subCategoriesArray, $category->id);
            }
        }
        return $this->subCategoriesArray;
    }

    public function parent()
    {
        return $this->belongsTo(get_class($this));
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
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
