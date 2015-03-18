<?php

namespace Byteland\BytelandDomain\Persistence\Doctrine;

use Byteland\BytelandDomain\Model;
use Byteland\BytelandDomain\Persistence;

class DoctrineRestaurantRepository implements RestaurantRepository
{
    public function find($restaurantId){}

    public function findAll(){}

    public function add(Restaurant $restaurant){}

    public function edit(Resstaurant $restaurant){}

    public function remove($restaurantId){}
}