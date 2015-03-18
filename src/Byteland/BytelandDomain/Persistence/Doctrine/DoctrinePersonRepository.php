<?php

namespace Byteland\BytelandDomain\Persistence\Doctrine;

use Byteland\BytelandDomain\Model;
use Byteland\BytelandDomain\Persistence;

class DoctrinePersonRepository implements Persistence\PersonRepository
{
    public function find($userId){}

    public function findAll(){}

    public function add(User $user){}

    public function edit(User $user){}

    public function remove($userId){}
}