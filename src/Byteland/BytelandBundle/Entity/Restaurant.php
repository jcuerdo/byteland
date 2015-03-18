<?php

namespace Byteland\BytelandBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Restaurant
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Byteland\BytelandBundle\Entity\RestaurantRepository")
 */
class Restaurant
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_accepted_people", type="integer")
     */
    private $maxAcceptedPeople;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="restaurant")
     */
    private $bookings;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="restaurant")
     */
    private $availabilities;

    /**
     * @return array
     */
    public function getAvailabilities()
    {
        return $this->availabilities;
    }

    /**
     * @param array $availabilities
     */
    public function setAvailabilities($availabilities)
    {
        $this->availabilities = $availabilities;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bookings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->availabilities = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * @return array
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * @param array $bookings
     */
    public function setBookings($bookings)
    {
        $this->bookings = $bookings;
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
     * Set name
     *
     * @param string $name
     * @return Restaurant
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set maxAcceptedPeople
     *
     * @param integer $maxAcceptedPeople
     * @return Restaurant
     */
    public function setMaxAcceptedPeople($maxAcceptedPeople)
    {
        $this->maxAcceptedPeople = $maxAcceptedPeople;

        return $this;
    }

    /**
     * Get maxAcceptedPeople
     *
     * @return integer 
     */
    public function getMaxAcceptedPeople()
    {
        return $this->maxAcceptedPeople;
    }
}
