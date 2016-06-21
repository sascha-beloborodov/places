<?php
/**
 * Created by PhpStorm.
 * User: sascha
 * Date: 6/20/2016
 * Time: 2:24 PM
 */

namespace App\Factories;

use App\Entities\Area;

class AreaFactory {

    /**
     * @param $class
     * @param null $zoom
     * @param null $ltd
     * @param null $lng
     * @return Area object
     */
    public function createArea($class, $zoom, $minLtd, $maxLtd, $minLng, $maxLng)
    {
        $params = [];

        $params['zoom'] = $zoom;

        $params['min_ltd'] = $minLtd;
        
        $params['max_ltd'] = $maxLtd;

        $params['min_lng'] = $minLng;
        
        $params['max_lng'] = $maxLng;

        $reflector = new \ReflectionClass('App\\Entities\\' . $class);
        $area = $reflector->newInstanceArgs($params);
        return $area;
    }
}