<?php

namespace Byteland\BytelandDomain\Persistence\Doctrine;

use Byteland\BytelandBundle\Entity\RestaurantRepository;
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
        $restaurant_repository = new RestaurantRepository($this->em);
        $restaurant = $restaurant_repository->find($booking->getRestaurant()->getId());

        if(!$restaurant->isAvailable()){
            throw new \Exception("Restaurant not Available");
        }

        $doctrine_booking = new \Byteland\BytelandBundle\Entity\Booking();
        $doctrine_booking->setDate($booking->getDate());
        $doctrine_person = $this->em->getRepository('BytelandBundle:Person')->find($booking->getPerson()->getId());
        $doctrine_restaurant = $this->em->getRepository('BytelandBundle:Restaurant')->find($booking->getRestaurant()->getId());
        $doctrine_booking->setRestaurant($doctrine_restaurant);
        $doctrine_booking->setPerson($doctrine_person);

        $this->em->persist($doctrine_booking);
        $this->em->flush();
    }
}