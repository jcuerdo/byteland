<?php

namespace Byteland\BytelandDomain\Persistence;

use Byteland\BytelandDomain\Model\Availability;

interface AvailabilityRepository
{
    public function add(Availability $availability);
}