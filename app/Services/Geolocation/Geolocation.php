<?php

namespace App\Services\Geolocation;

use App\Services\Map\Map;
use App\Services\Address\Satellite;

class Geolocation 
{
    private $map;
    private $satellite;
    public function __construct(Map $map,Satellite $satellite) {
        $this->map = $map;
        $this->satellite = $satellite;
    }

    public function search(string $name){
        $locationinfo = $this->map->findaddress($name);
        return $this->satellite->pinpoint($locationinfo);
    }
}
