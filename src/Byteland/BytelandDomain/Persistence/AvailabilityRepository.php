<?php

namespace Byteland\BytelandDomain\Persistence;

use Byteland\BytelandDomain\Model;

interface BookingRepository
{
    public function add(Availability $availability);
}