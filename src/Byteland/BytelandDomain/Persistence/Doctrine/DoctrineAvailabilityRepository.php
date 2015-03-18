<?php

namespace Byteland\BytelandDomain\Persistence\Doctrine;

use Byteland\BytelandDomain\Model\Availability;
use Byteland\BytelandDomain\Persistence\AvailabilityRepository;

class DoctrineAvailabilityRepository extends DoctrineGenericRepository implements AvailabilityRepository
{
    public function __construct($em)
    {
        parent::__construct($em);
    }
    public function add(Availability $availability){}
}