<?php namespace App\Services\Models;

use Eloquent;
use App\User;

/**
 * Class Status
 *
 * @property \App\User                $author
 */
class Status extends \App\Status{

    /**
     * @var string
     */
    protected $table = 'services_statuses';
}
