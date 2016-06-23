<?php namespace App\Employees\Models;

/**
 * Class Status
 *
 * @property \App\User                $author
 */
class EmployeesCategories {

    /**
     * @var Category
     */
    private $categories;

    public function getCategories()
    {
        if ( !$this->categories ) {
            $this->categories = new Category;
        }

        return $this->categories->where('parentId', '=', 0)->get();
    }
}
