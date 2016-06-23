<?php
namespace app\Views;

use App\Interfaces\Metable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;

class ViewModel
{
    /**
     * @var string
     */
    protected $template = '';
    /**
     * @var array
     */
    private $content  = [];

    /**
     * @return string
     */
    protected function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return array
     */
    protected function getContent()
    {
        return $this->content;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function setContent($name, $value)
    {
        $this->content[$name] = $value;
        return $this;
    }

    /**
     * @param array $contentsArr
     * @return $this
     */
    public function setContents( $contentsArr )
    {
        $this->content = array_merge($this->content, $contentsArr);
        return $this;
    }

    /**
     * @param Metable $object
     * @return $this
     */
    protected function setMetaFromObject( Metable $object )
    {
        return $this->setMetaTitle($object->getMetaTitle())
            ->setMetaKeywords($object->getMetaKeywords())
            ->setMetaDescription($object->getMetaDescription());
    }

    protected function setMetaFromLang( $langSource )
    {

        return $this->setMetaTitle(Lang::get($langSource.'.metaTitle'))
            ->setMetaKeywords($langSource.'.metaKeywords')
            ->setMetaDescription($langSource.'.metaDescription');
    }

    /**
     * @param string $title
     * @return ViewModel
     */
    protected function setMetaTitle($title)
    {
        return $this->setContent('metaTitle', $title);
    }

    /**
     * @param string $keywords
     * @return ViewModel
     */
    protected function setMetaKeywords($keywords)
    {
        return $this->setContent('metaKeywords', $keywords);
    }

    /**
     * @param string $description
     * @return ViewModel
     */
    protected function setMetaDescription($description)
    {
        return $this->setContent('metaKeywords', $description);
    }

    /**
     * @return mixed
     */
    public function render()
    {
        return View::make($this->getTemplate(), $this->getContent());
    }
}