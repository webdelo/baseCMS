<?php namespace App\Article\Models;

/**
 * Class Status
 *
 * @property \App\User                $author
 */
class Category extends \App\Category {

    /**
     * @var string
     */
    protected $table = 'articles_categories';

    /**
     * @return Employees
     */
    public function items()
    {
        return $this->hasMany(Article::class, 'categoryId', 'id');
    }
}
