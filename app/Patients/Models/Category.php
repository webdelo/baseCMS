<?php namespace App\Patients\Models;

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
    protected $table = 'patients_categories';

    /**
     * @return Patients
     */
    public function items()
    {
        return $this->hasMany(Patient::class, 'categoryId', 'id');
    }
}
