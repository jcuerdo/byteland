<?php

namespace Byteland\BytelandDomain\Persistence\Doctrine;

use Byteland\BytelandDomain\Model\Person;
use Byteland\BytelandDomain\Persistence\PersonRepository;

class DoctrinePersonRepository extends DoctrineGenericRepository implements PersonRepository
{
    public function __construct($em)
    {
        parent::__construct($em);
    }
    public function find($userId){}

    public function findAll(){}

    public function add(Person $person){}

    public function edit(Person $person){}

    public function remove($userId){}
}