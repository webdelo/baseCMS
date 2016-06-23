<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 14.11.2015
 * Time: 18:35
 */

namespace App\Images;

use App\Images\Image;
use App\Images\ImageSizes;
use App\Interfaces\Imaginable;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ObjectImage implements \App\Interfaces\Imaginable
{
    private $object;
    private $image;

    public function __construct(Imaginable $object)
    {
        $this->object = $object;
    }

    public function add(UploadedFile $file)
    {
        if ( $this->addToDb($file) ) {
            return $file->move($this->getStoragePath(), $this->getName());
        }
        return false;
    }

    private function addToDb(UploadedFile $file)
    {
        $image = new Image($this->getObject());
        $image->title       = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());
        $image->mime        = $file->getClientMimeType();
        $image->ext         = $file->getClientOriginalExtension();
        $image->filename    = $file->getClientOriginalName();
        $image->size        = $file->getClientSize();
        $image->objectId    = $this->getObject()->id;
        $image->statusId    = 1;
        $image->categoryId  = 1;
        $image->save();

        return $this->setImage($image)->getImage()->id;
    }

    private function setImage(Image $image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return Image
     */
    public function getImage()
    {
        return $this->image;
    }

    private function getName()
    {
        return $this->getImage()->id.'.'.$this->getImage()->getExtension();
    }

    public function getStoragePath()
    {
        return storage_path() . $this->getPath();
    }

    public function remove(Image $image)
    {
        foreach ( ImageSizes::$possibleSizes as $size ) {
            if ( file_exists($image->getFilepath($size)) )
                if ( !\Illuminate\Support\Facades\File::delete($image->getFilepath($size)) )
                    throw new \Exception('Can\'t remove image');
        }

        $res = \Illuminate\Support\Facades\File::delete($image->getRealfilepath());
        if ( $res ) {
            return $image->delete();
        }

        return false;
    }

    private function getObject()
    {
        return $this->object;
    }

    public function getImagesTable()
    {
        return $this->getObject()->getImagesTable();
    }

    public function getFolder()
    {
        return $this->getObject()->getFolder();
    }

    public function getPath()
    {
        return $this->getObject()->getPath();
    }
}