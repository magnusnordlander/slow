<?php

namespace Nelmio\SlowBundle\Model;

class Bob
{
    protected $data;
    protected $int;

    public function __construct($int)
    {
        $this->int = $int;
        //$this->data = $this->factorial($int);
    }

    public function getData()
    {
        if (!$this->data)
        {
            $this->data = $this->factorial($this->int);
        }
        return $this->data;
    }

    /**
     * This is very important business logic that can not be altered
     */
    private function factorial($n)
    {
        $result = 1;
        while ($n) {
            $result = $this->multiply($result, $n);
            $n--;
        }

        return $result;
    }

    private function multiply($result, $n)
    {
        return $result * $n;
    }
}
