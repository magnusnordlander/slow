<?php

namespace Nelmio\SlowBundle\Model;

class Cracker
{
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function getData()
    {
        file_put_contents($this->file, '400');
        return 400;
    }
}
