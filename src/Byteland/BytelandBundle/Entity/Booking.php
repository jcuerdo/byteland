<?php

namespace Byteland\BytelandBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Booking
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Byteland\BytelandBundle\Entity\BookingRepository")
 */
class Booking
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var Person
     *
     * @ORM\OneToOne(targetEntity="Person")
     */
    private $person;

    /**
     * @var Restaurant
     *
     * @ORM\OneToOne(targetEntity="Restaurant")
     */
    private $restaurant;

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param Person $person
     */
    public function setPerson($person)
    {
        $this->person = $person;
    }

    /**
     * @return Restaurant
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    /**
     * @param Restaurant $restaurant
     */
    public function setRestaurant($restaurant)
    {
        $this->restaurant = $restaurant;
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Booking
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
}
