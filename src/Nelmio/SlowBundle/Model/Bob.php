<?php

namespace Nelmio\SlowBundle\Model;

class Bob
{
    protected $data;
    protected $int;
    protected $cache_key;

    public function __construct($int)
    {
        $this->int = $int;
        $this->cache_key = 'bob-'.$int;
    }

    public function getData()
    {
        if (!$this->data)
        {
            if (apc_exists($this->cache_key))
            {
                $this->data = apc_fetch($this->cache_key);
            }
            else
            {
                $this->data = $this->factorial($this->int);
                apc_store($this->cache_key, $this->data);
            }
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
