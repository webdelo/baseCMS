<?php namespace App\Gallery\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Small implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}