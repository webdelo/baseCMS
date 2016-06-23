<?php
/**
 * Created by PhpStorm.
 * User: rainx_000
 * Date: 14.11.2015
 * Time: 18:35
 */

namespace App\Patients\Models;

use App\Images\ImageSizes;
use App\Patients\Models\Patient;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PatientImageHandler
{
    private $path = '/images/patients/';
    private $object;

    public function __construct(Patient $object)
    {
        $this->object = $object;
    }

    public function add(UploadedFile $file)
    {
        if ( $this->object->image ) {
            $this->object->image->delete();
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
        $image->objectId    = $this->object->id;
        $image->statusId    = 1;
        $image->categoryId  = 1;
        $image->save();

        return $this->setImage($image)->getImage()->id;
    }

    private function setImage(Image $image)
    {
//        var_dump($image);
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