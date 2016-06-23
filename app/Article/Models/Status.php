<?php namespace App\Article\Models;

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
    protected $table = 'articles_statuses';
}
