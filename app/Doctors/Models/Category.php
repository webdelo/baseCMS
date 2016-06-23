<?php namespace App\Doctors\Models;

use Eloquent;
use App\User;
use Illuminate\Support\Facades\DB;

/**
 * Class Status
 *
 * @property \App\User                $author
 */
class Category extends \App\Category {

    /**
     * @var string
     */
    protected $table = 'employees_categories';

    /**
     * @return Employees
     */
    public function items()
    {
        return $this->hasMany(Employee::class, 'categoryId', 'id');
    }
}
