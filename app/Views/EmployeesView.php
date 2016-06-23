<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 29.02.2016
 * Time: 21:37
 */

namespace App\Views;

use App\Article\Models\Article;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;

class EmployeesView extends ViewModel implements iView
{

    protected $template = 'employees.list';

    public function __construct()
    {
        $this->setMetaFromLang('meta.employees');
    }
}