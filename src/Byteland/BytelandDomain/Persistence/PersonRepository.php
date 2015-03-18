<?php

namespace Byteland\BytelandDomain\Persistence;

use Byteland\BytelandDomain\Model;

interface PersonRepository
{
    public function find($userId);

    public function findAll();

    public function add(User $user);

    public function edit(User $user);

    public function remove($userId);
}