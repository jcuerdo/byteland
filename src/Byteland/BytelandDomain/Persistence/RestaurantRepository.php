<?php

namespace Byteland\BytelandDomain\Persistence;

use Byteland\BytelandDomain\Model\Restaurant;

interface RestaurantRepository
{
    public function find($restaurantId);

    public function findAll();

    public function add(Restaurant $restaurant);

    public function edit(Restaurant $restaurant);

    public function remove($restaurantId);
}