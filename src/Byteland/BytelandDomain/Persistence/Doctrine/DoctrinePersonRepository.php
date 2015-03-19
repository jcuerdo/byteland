<?php

namespace Byteland\BytelandDomain\Persistence\Doctrine;

use Byteland\BytelandDomain\Model\Restaurant;
use Byteland\BytelandDomain\Model\Booking;
use Byteland\BytelandDomain\Model\Person;
use Byteland\BytelandDomain\Persistence\PersonRepository;

class DoctrinePersonRepository extends DoctrineGenericRepository implements PersonRepository
{
    public function __construct($em)
    {
        parent::__construct($em);
    }
    public function find($userId)
    {
        $bookings = array();
        $doctrine_person = $this->em->getRepository('BytelandBundle:Person')->find($userId);

        $bookings = $this->loadDoctrineBookings($doctrine_person, $bookings);

        $person = new Person($doctrine_person->getId(),$doctrine_person->getName(),$bookings) ;

        return $person;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $persons = array();
        $doctrine_persons = $this->em->getRepository('BytelandBundle:Person')->findAll();
        foreach($doctrine_persons as $doctrine_person)
        {
           $persons[] = new Person($doctrine_person->getId(),$doctrine_person->getName()) ;
        }

        return $persons;
    }

    public function add(Person $person)
    {
        $doctrine_person = new \Byteland\BytelandBundle\Entity\Person();

        if(!empty($person->getName()))
        {
            $doctrine_person->setName($person->getName());
        }

        $this->em->persist($doctrine_person);
        $this->em->flush();
    }

    public function edit(Person $person)
    {
        $doctrine_person = $this->em->getRepository('BytelandBundle:Person')->find($person->getId());

        if(!empty($person->getName()))
        {
            $doctrine_person->setName($person->getName());
        }

        $this->em->persist($doctrine_person);
        $this->em->flush();
    }

    public function remove($userId)
    {
        $doctrine_person = $this->em->getRepository('BytelandBundle:Person')->find($userId);

        if (!$doctrine_person) {
            throw $this->createNotFoundException('Unable to find Person entity.');
        }

        $this->em->remove($doctrine_person);
        $this->em->flush();
    }

    /**
     * @param $doctrine_person
     * @param $bookings
     * @return array
     */
    private function loadDoctrineBookings($doctrine_person, $bookings)
    {
        foreach ($doctrine_person->getBookings() as $doctrine_booking) {
            $bookings[] = new Booking(
                $doctrine_booking->getId(),
                $doctrine_booking->getDate(),
                new Restaurant(
                    $doctrine_booking->getRestaurant()->getId(),
                    $doctrine_booking->getRestaurant()->getName()
                ),
                null
            );
        }
        return $bookings;
    }
}