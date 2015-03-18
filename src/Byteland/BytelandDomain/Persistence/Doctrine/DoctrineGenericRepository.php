<?php

namespace Byteland\BytelandDomain\Persistence\Doctrine;


abstract class DoctrineGenericRepository
{
    protected $em;

    public function __construct($em)
    {
        $this->em = $em;
    }
}