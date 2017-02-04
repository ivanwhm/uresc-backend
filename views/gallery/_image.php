<?php
//Imports

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

try {
    $image = new \Imagine\Imagick\Imagine();
} catch (Exception $e)
{
    $image = new \Imagine\Gd\Imagine();
}

$file = $model->getGallery()->getGalleryDirectory() . $model->filename;

if (($image instanceof \Imagine\Imagick\Imagine) or ($image instanceof \Imagine\Gd\Imagine))
{
    $imageFile = $image->open($file);
    $resize = $imageFile->getSize()->widen(150);
    $imageFile->resize($resize, ImageInterface::FILTER_UNDEFINED)->show('jpeg');
}
exit;