<?php

namespace Nelmio\SlowBundle\Model;

class TreeBuilder
{
    protected $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function getData()
    {
        return $this->em->getRepository('NelmioSlowBundle:Tree')
            ->createQueryBuilder('t')
            ->join('t.children c')
            ->join('c.children cc')
            ->where('t.parent IS NULL')
            ->getQuery()->getResult();
    }
}
