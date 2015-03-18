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
     * @var array
     *
     */
    private $bookings;

    /**
     * Constructor
     */
    public function __construct($id, $name, $bookings = array())
    {
        $this->id = $id;
        $this->name = $name;
        $this->bookings = $bookings;
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
     * @return array
     */
    public function getBookings()
    {
        return $this->bookings;
    }


}