<?php namespace App\Services\Models;

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
    protected $table = 'services_categories';

    /**
     * @return Services
     */
    public function items()
    {
        return $this->hasMany(Service::class, 'categoryId', 'id');
    }

    public function getMinPrice()
    {
        $res = DB::table('services')
                    ->whereIn('categoryId', array_merge($this->subCategoriesArray(), [$this->id]))
                    ->min('price');
        return $res;
    }

    public function getMaxPrice()
    {
        $res = DB::table('services')
                    ->whereIn('categoryId', array_merge($this->subCategoriesArray(), [$this->id]))
                    ->max('price');
        return $res;
    }
}
