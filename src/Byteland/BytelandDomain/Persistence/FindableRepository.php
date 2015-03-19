<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 19/03/2015
 * Time: 22:34
 */

namespace Byteland\BytelandDomain\Persistence;


interface FindableRepository {
    public function find($userId);

    public function findAll();
}