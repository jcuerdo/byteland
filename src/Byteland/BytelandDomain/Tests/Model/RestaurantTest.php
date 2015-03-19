<?php


namespace Byteland\BytelandDomain\Model;


class RestaurantTest extends \PHPUnit_Framework_TestCase {

    private $test_bookings;

    public function setUp()
    {
        $this->test_bookings = array(
        new Booking(1, new \DateTime('today')),
        new Booking(1, new \DateTime('tomorrow')),
        );
    }

    public function testIsAvailable()
    {
        $availabilities = array(
            new Availability(1,new \DateTime('today')),
        );
        $restaurant = new Restaurant(1, 'Test Restaurant', 3, $this->test_bookings, $availabilities);

        $isAvailable = $restaurant->isAvailable(new \DateTime('today'));

        $this->assertTrue($isAvailable);
    }

    public function testIsnotAvailable()
    {
        $availabilities = array(
            new Availability(1,new \DateTime('tomorrow')),
        );

        $restaurant = new Restaurant(1, 'Test Restaurant', 3, $this->test_bookings, $availabilities);

        $isAvailable = $restaurant->isAvailable(new \DateTime('today'));

        $this->assertFalse($isAvailable);
    }

    public function testIsAvailableButFull()
    {
        $availabilities = array(
            new Availability(1,new \DateTime('today')),
        );
        $restaurant = new Restaurant(1, 'Test Restaurant', 2, $this->test_bookings, $availabilities);

        $isAvailable = $restaurant->isAvailable(new \DateTime('today'));

        $this->assertFalse($isAvailable);
    }

}