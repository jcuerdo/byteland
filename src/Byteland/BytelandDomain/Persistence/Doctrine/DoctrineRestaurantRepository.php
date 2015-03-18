<?php

namespace Byteland\BytelandDomain\Persistence\Doctrine;

use Byteland\BytelandDomain\Model\Availability;
use Byteland\BytelandDomain\Model\Restaurant;
use Byteland\BytelandDomain\Model\Person;
use Byteland\BytelandDomain\Model\Booking;
use Byteland\BytelandDomain\Persistence\RestaurantRepository;

class DoctrineRestaurantRepository extends DoctrineGenericRepository implements RestaurantRepository
{
    public function __construct($em)
    {
        parent::__construct($em);
    }
    public function find($restaurantId)
    {
        $bookings = array();
        $availabilities = array();
        $doctrine_restaurant = $this->em->getRepository('BytelandBundle:Restaurant')->find($restaurantId);

        foreach($doctrine_restaurant->getBookings() as $doctrine_booking)
        {
            $bookings[] = new Booking(
                $doctrine_booking->getId(),
                $doctrine_booking->getDate(),
                new Restaurant(
                    $doctrine_booking->getRestaurant()->getId(),
                    $doctrine_booking->getRestaurant()->getName()
                ),
                new Person(
                    $doctrine_booking->getPerson()->getId(),
                    $doctrine_booking->getPerson()->getName()
                )
            );
        }

        foreach($doctrine_restaurant->getAvailabilities() as $doctrine_availability)
        {
            $availabilities[] = new Availability(
                $doctrine_availability->getId(),
                $doctrine_availability->getDate()
            );
        }

        $restaurant = new Restaurant(
            $doctrine_restaurant->getId(),
            $doctrine_restaurant->getName(),
            $doctrine_restaurant->getMaxAcceptedPeople(),
            $bookings,
            $availabilities) ;

        return $restaurant;
    }

    public function findAll()
    {
        $doctrine_restaurants = $this->em->getRepository('BytelandBundle:Restaurant')->findAll();
        $restaurants = array();
        foreach($doctrine_restaurants as $doctrine_restaurant)
        {
            $restaurants[] = new Restaurant(
                $doctrine_restaurant->getId(),
                $doctrine_restaurant->getName(),
                $doctrine_restaurant->getMaxAcceptedPeople()
            ) ;
        }
        return $restaurants;
    }

    public function add(Restaurant $restaurant)
    {
        $doctrine_restaurant = new \Byteland\BytelandBundle\Entity\Restaurant();

        $doctrine_restaurant->setName($restaurant->getName());
        $doctrine_restaurant->setMaxAcceptedPeople($restaurant->getMaxAcceptedPeople());

        $this->em->persist($doctrine_restaurant);
        $this->em->flush();
    }

    public function edit(Restaurant $restaurant)
    {
        $doctrine_restaurant = $this->em->getRepository('BytelandBundle:Restaurant')->find($restaurant->getId());

        if(!empty($restaurant->getName())){
            $doctrine_restaurant->setName($restaurant->getName());
        }

        if(!empty($restaurant->getMaxAcceptedPeople())) {
            $doctrine_restaurant->setMaxAcceptedPeople($restaurant->getMaxAcceptedPeople());
        }

        $this->em->persist($doctrine_restaurant);
        $this->em->flush();
    }

    public function remove($restaurantId)
    {
        $doctrine_restaurant = $this->em->getRepository('BytelandBundle:Restaurant')->find($restaurantId);

        if (!$doctrine_restaurant) {
            throw $this->createNotFoundException('Unable to find Restaurant entity.');
        }

        $this->em->remove($doctrine_restaurant);
        $this->em->flush();
    }
}