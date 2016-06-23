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

class ContactsView extends ViewModel implements iView
{
    private $settings = [
        'inTheWeek'      => 'inTheWeek',
        'atTheSaturday'  => 'atTheSaturday',
        'phones'         => 'phones',
        'skype'          => 'skype',
        'email'          => 'email',
    ];

    protected $template = 'contacts';

    public function __construct()
    {
        foreach ( $this->settings as $key=>$alias ) {
            $this->setContent($key, $this->_getArticleByAlias($alias));
        }

        $this->setMetaFromLang('meta.contacts');
    }

    private function _getArticleByAlias( $alias )
    {
        $articles = new Article();
        return $articles->where('alias', '=', $alias)->first();
    }
}