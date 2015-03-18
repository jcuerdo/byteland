<?php

namespace Byteland\BytelandDomain\Persistence\Doctrine;

use Byteland\BytelandDomain\Model\Booking;
use Byteland\BytelandDomain\Persistence\BookingRepository;

class DoctrineBookingRepository extends DoctrineGenericRepository implements BookingRepository
{
    public function __construct($em)
    {
        parent::__construct($em);
    }
    public function add(Booking $booking){}
}