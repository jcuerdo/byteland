<?php

namespace Byteland\BytelandDomain\Persistence\Doctrine;

use Byteland\BytelandDomain\Model\Booking;
use Byteland\BytelandDomain\Persistence\BookingRepository;
use Symfony\Component\Config\Definition\Exception\Exception;

class DoctrineBookingRepository extends DoctrineGenericRepository implements BookingRepository
{
    public function __construct($em)
    {
        parent::__construct($em);
    }
    public function add(Booking $booking)
    {
        $doctrine_booking = new \Byteland\BytelandBundle\Entity\Booking();
        $doctrine_booking->setDate($booking->getDate());

        $doctrine_restaurant = $this->em->getRepository('BytelandBundle:Restaurant')->find($booking->getRestaurant()->getId());
        $doctrine_bookings =  $this->em->getRepository('BytelandBundle:Booking')->findByDate($doctrine_restaurant, $booking->getDate());

        $doctrine_availability =  $this->em->getRepository('BytelandBundle:Availability')->findByDate($doctrine_restaurant, $booking->getDate());

        if(count($doctrine_bookings) >= $doctrine_restaurant->getMaxAcceptedPeople()) {
            throw new \Exception('RESTAURANT FULL');
        }
        if(count($doctrine_availability) == 0){
            throw new \Exception('RESTAURANT NOT AVAILABLE');
        }

        $person = $this->em->getRepository('BytelandBundle:Person')->find($booking->getPerson()->getId());

        $doctrine_booking->setRestaurant($doctrine_restaurant);
        $doctrine_booking->setPerson($person);

        $this->em->persist($doctrine_booking);
        $this->em->flush();
    }
}