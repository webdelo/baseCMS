<?php namespace App\Gallery\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Medium implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(600, 600, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}