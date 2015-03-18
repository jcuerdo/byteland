<?php

namespace Byteland\BytelandDomain\Model;


class Person {

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
    public function __construct($id, $name, $maxAcceptedPeople, $bookings = array(), $availabilities = array())
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



}