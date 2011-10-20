<?php

namespace Nelmio\SlowBundle\Model;

use Imagine\Image\ImagineInterface;
use Imagine\Image\ImageInterface;
use Imagine\Image\Box;

class Resizer
{
    protected $file;
    protected $imagine;

    public function __construct($file, ImagineInterface $imagine)
    {
        $this->file = $file;
        $this->imagine = $imagine;
    }

    public function getImageData()
    {
        $width = 40;
        $height = 40;
        $thumbnail_type = ImageInterface::THUMBNAIL_INSET
        $cache_key = 'resizer-'.$width.'-'.$height.'-'.$thumbnail_type.'-'.$this->file.'-'.filemtime($this->file);

        if (!apc_exists($cache_key))
        {
            $size = new Box($width, $height);
            $image = $this->imagine->open($this->file)->thumbnail($size, $thumbnail_type);
            $base_64 = base64_encode($image->get('png'));
            apc_store($cache_key, $base_64);

            return $base_64;
        }
        else
        {
            return apc_fetch($cache_key);
        }

    }

    public function getData()
    {
        return '<img src="data:image/png;base64,'.$this->getImageData().'" />';
    }
}
