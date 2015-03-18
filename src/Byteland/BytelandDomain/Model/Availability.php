<?php

namespace Byteland\BytelandDomain\Model;


class Availability {

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
     * @var Restaurant
     *
     */
    private $restaurant;

    /**
     * Constructor
     */
    public function __construct($id, $date, Restaurant $restaurant = null)
    {
        $this->id = $id;
        $this->date = $date;
        $this->restaurant = $restaurant;
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
     * @return Restaurant
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }
}