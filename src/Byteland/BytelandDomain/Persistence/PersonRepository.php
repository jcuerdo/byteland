<?php

namespace Byteland\BytelandDomain\Persistence;

use Byteland\BytelandDomain\Model\Person;

interface PersonRepository
{
    public function find($userId);

    public function findAll();

    public function add(Person $person);

    public function edit(Person $person);

    public function remove($userId);
}