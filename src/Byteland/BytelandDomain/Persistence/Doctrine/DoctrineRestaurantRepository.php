<?php

namespace Byteland\BytelandDomain\Persistence\Doctrine;

use Byteland\BytelandDomain\Model\Restaurant;
use Byteland\BytelandDomain\Persistence\RestaurantRepository;

class DoctrineRestaurantRepository extends DoctrineGenericRepository implements RestaurantRepository
{
    public function __construct($em)
    {
        parent::__construct($em);
    }
    public function find($restaurantId){}

    public function findAll(){}

    public function add(Restaurant $restaurant){}

    public function edit(Resstaurant $restaurant){}

    public function remove($restaurantId){}
}