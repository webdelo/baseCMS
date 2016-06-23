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

class GalleryView extends ViewModel implements iView
{

    protected $template = 'gallery.list';

    public function __construct()
    {
        $this->setMetaFromLang('meta.gallery');
    }
}