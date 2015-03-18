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
    public function add(Availability $availability)
    {
        $doctrine_availability = new \Byteland\BytelandBundle\Entity\Availability();
        $doctrine_availability->setDate($availability->getDate());

        $doctrine_restaurant = $this->em->getRepository('BytelandBundle:Restaurant')->find($availability->getRestaurant()->getId());

        $doctrine_availability->setRestaurant($doctrine_restaurant);

        $this->em->persist($doctrine_availability);
        $this->em->flush();
    }
}