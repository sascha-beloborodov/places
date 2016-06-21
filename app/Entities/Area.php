<?php
/**
 * Created by PhpStorm.
 * User: sascha
 * Date: 6/20/2016
 * Time: 2:31 PM
 */

namespace App\Entities;

class Area {

    const SIGNS = 6;

    private $zoom;
    private $minLatitude;
    private $maxLatitude;
    private $minLongitude;
    private $maxLongitude;

    /**
     * Area constructor.
     * @param $zoom
     * @param $minLatitude
     * @param $maxLatitude
     * @param $minLongitude
     * @param $maxLongitude
     */
    public function __construct($zoom, $minLatitude, $maxLatitude, $minLongitude, $maxLongitude)
    {
        $this->zoom = $zoom;
        $this->minLatitude = (float) number_format($minLatitude, self::SIGNS);
        $this->maxLatitude = (float) number_format($maxLatitude, self::SIGNS);
        $this->minLongitude = (float) number_format($minLongitude, self::SIGNS);
        $this->maxLongitude = (float) number_format($maxLongitude, self::SIGNS);
    }

    /**
     * @return mixed
     */
    public function getZoom()
    {
        return $this->zoom;
    }

    /**
     * @param mixed $zoom
     */
    public function setZoom($zoom)
    {
        $this->zoom = $zoom;
    }

    /**
     * @return mixed
     */
    public function getMinLatitude()
    {
        return $this->minLatitude;
    }

    /**
     * @param mixed $minLatitude
     */
    public function setMinLatitude($minLatitude)
    {
        $this->minLatitude = $minLatitude;
    }

    /**
     * @return mixed
     */
    public function getMaxLatitude()
    {
        return $this->maxLatitude;
    }

    /**
     * @param mixed $maxLatitude
     */
    public function setMaxLatitude($maxLatitude)
    {
        $this->maxLatitude = $maxLatitude;
    }

    /**
     * @return mixed
     */
    public function getMinLongitude()
    {
        return $this->minLongitude;
    }

    /**
     * @param mixed $minLongitude
     */
    public function setMinLongitude($minLongitude)
    {
        $this->minLongitude = $minLongitude;
    }

    /**
     * @return mixed
     */
    public function getMaxLongitude()
    {
        return $this->maxLongitude;
    }

    /**
     * @param mixed $maxLongitude
     */
    public function setMaxLongitude($maxLongitude)
    {
        $this->maxLongitude = $maxLongitude;
    }


}