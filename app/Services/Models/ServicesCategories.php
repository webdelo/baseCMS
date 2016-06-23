<?php namespace App\Services\Models;

use Eloquent;
use App\User;

/**
 * Class Status
 *
 * @property \App\User                $author
 */
class ServicesCategories {

    /**
     * @var Category
     */
    private $categories;

    public function getCategories()
    {
        if ( !$this->categories ) {
            $this->categories = new Category;
        }

        return $this->categories->where('parentId', '=', 0)->where('statusId','=',1)->get();
    }
}
