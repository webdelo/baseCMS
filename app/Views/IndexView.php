<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 29.02.2016
 * Time: 21:37
 */

namespace App\Views;

use App\Article\Models\Article;
use Illuminate\Support\Facades\View;

class IndexView extends ViewModel implements iView
{
    private $settings = [
        'mainArticle'   => 'forMainPage',
        'firstArticle'  => 'firstIndex',
        'secondArticle' => 'secondIndex',
        'thirdArticle'  => 'thirdIndex',
    ];

    protected $template = 'welcome';

    public function __construct()
    {
        foreach ( $this->settings as $key=>$alias ) {
            $this->setContent($key, $this->_getArticleByAlias($alias));
        }

        $this->setMetaFromObject($this->getContent()['mainArticle']);
    }

    private function _getArticleByAlias( $alias )
    {
        $articles = new Article();
        return $articles->where('alias', '=', $alias)->first();
    }
}