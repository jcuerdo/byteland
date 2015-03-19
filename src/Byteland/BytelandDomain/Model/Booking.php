<?php

namespace Byteland\BytelandDomain\Model;


class Booking {

    /**
     * @var integer
     *
     */
    private $id;

    /**
     * @var \DateTime
     *
     */
    private $date;

    /**
     * @var Person
     *
     */
    private $person;

    /**
     * @var Restaurant
     *
     */
    private $restaurant;

    /**
     * Constructor
     */
    public function __construct($id, $date, Restaurant $restaurant = null, Person $person = null)
    {
        $this->id = $id;
        $this->date = $date;
        $this->restaurant = $restaurant;
        $this->person = $person;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @return Restaurant
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }


}