<?php namespace App\Patients\Models;

use Eloquent;
use App\User;

/**
 * Class Status
 *
 * @property \App\User                $author
 */
class PatientsCategories {

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
