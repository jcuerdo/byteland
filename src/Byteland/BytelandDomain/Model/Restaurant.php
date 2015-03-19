<?php

namespace Byteland\BytelandDomain\Model;


class Restaurant {

    /**
     * @var integer
     *
     */
    private $id;

    /**
     * @var string
     *
     */
    private $name;

    /**
     * @var integer
     *
     */
    private $maxAcceptedPeople;

    /**
     * @var array
     *
     */
    private $bookings;

    /**
     * @var array
     *
     */
    private $availabilities;

    /**
     * Constructor
     */
    public function __construct($id, $name, $maxAcceptedPeople = 0, $bookings = array(), $availabilities = array())
    {
        $this->id = $id;
        $this->name = $name;
        $this->maxAcceptedPeople = $maxAcceptedPeople;
        $this->bookings = $bookings;
        $this->availabilities = $availabilities;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getMaxAcceptedPeople()
    {
        return $this->maxAcceptedPeople;
    }

    /**
     * @return array
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * @return array
     */
    public function getAvailabilities()
    {
        return $this->availabilities;
    }

    /**
     * @param DateTime $date
     *
     * @return bool
     */
    public function isAvailable(\DateTime $date)
    {
        foreach($this->availabilities as $availability) {
            if($availability->getDate() == $date) {
                return count($this->bookings) < $this->maxAcceptedPeople;
            }
        }
        return false;
    }



}