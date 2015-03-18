<?php

namespace Byteland\BytelandDomain\Persistence;

use Byteland\BytelandDomain\Model\Booking;

interface BookingRepository
{
    public function add(Booking $booking);
}