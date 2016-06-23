<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 01.12.2015
 * Time: 17:45
 */

namespace App\Time;


class Week
{
    /**
     * @var Year $_year
     */
    private $_year;

    /**
     * 1 Week
     */
    const SECONDS_IN = 604800;

    public function __construct( $number, Year $year )
    {
        $this->_year = $year;
    }

    public function weekends()
    {

    }
}