<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 14.11.2015
 * Time: 18:35
 */

namespace App\Gallery\Models;

use App\Images\ImageSizes;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class GalleryImageHandler
{
    private $path = '/images/gallery/';
    private $employee;

    public function __construct(Album $employee)
    {
        $this->employee = $employee;
    }

    public function add(UploadedFile $file)
    {
        if ( $this->employee->image ) {
            $this->employee->image->delete();
        }

        if ( $this->addToDb($file) ) {
            return $file->move($this->getPath(), $this->getName());
        }
        return false;
    }

    private function addToDb(UploadedFile $file)
    {
        $image = new Image();
        $image->title       = str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName());
        $image->mime        = $file->getClientMimeType();
        $image->ext         = $file->getClientOriginalExtension();
        $image->filename    = $file->getClientOriginalName();
        $image->size        = $file->getClientSize();
        $image->objectId    = $this->employee->id;
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

    public function getImage()
    {
        return $this->image;
    }

    private function getName()
    {
        return $this->getImage()->id.'.'.$this->getImage()->getExtension();
    }

    public function getPath()
    {
        return storage_path() . $this->path;
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
}