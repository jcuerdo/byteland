<?php

namespace Byteland\BytelandDomain\Persistence;

use Byteland\BytelandDomain\Model\Availability;

interface BookingRepository
{
    public function add(Availability $availability);
}