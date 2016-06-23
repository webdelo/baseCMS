<?php namespace App\Visits\Models;

use Eloquent;
use App\User;
use Illuminate\Support\Facades\DB;

/**
 * Class Status
 *
 * @property \App\User                $author
 */
class Category extends \App\Category{

    /**
     * @var string
     */
    protected $table = 'visits_categories';

    /**
     * @return Visits
     */
    public function items()
    {
        return $this->hasMany(Visit::class, 'categoryId', 'id');
    }
}
