<?php

/**
 * Created by PhpStorm.
 * User: sascha
 * Date: 6/20/2016
 * Time: 5:29 PM
 */

namespace App\Entities;

class Map {

    const MAX_LONGITUDE = 180;
    const MAX_LATITUDE = 90;
    const MIN_LONGITUDE = -180;
    const MIN_LATITUDE = -90;

    /**
     * Checking input coords
     * @param float $minLng
     * @param float$maxLng
     * @param float $minLtd
     * @param float $maxLtd
     * @return bool
     */
    public function checkCoords($minLng, $maxLng, $minLtd, $maxLtd)
    {
        $minLng = (float) $minLng;
        $maxLng = (float) $maxLng;
        $minLtd = (float) $minLtd;
        $maxLtd = (float) $maxLtd;
        if (self::MAX_LATITUDE < $maxLtd || self::MIN_LATITUDE > $maxLtd) return false;
        if (self::MAX_LATITUDE < $minLtd || self::MIN_LATITUDE > $minLtd) return false;
        if (self::MAX_LONGITUDE < $minLng || self::MIN_LONGITUDE > $minLng) return false;
        if (self::MAX_LONGITUDE < $maxLng || self::MIN_LONGITUDE > $maxLng) return false;
        return true;
    }
}