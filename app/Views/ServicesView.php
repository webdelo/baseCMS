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

class ServicesView extends ViewModel implements iView
{

    protected $template = 'services.list';

    public function __construct()
    {
        $this->setMetaFromLang('meta.services');
    }
}