<?php

namespace App\Http\Controllers;

use App\Entities\Area;
use App\Factories\AreaFactory;
use Illuminate\Http\Request;
use Cache;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlaceController extends Controller
{

    const MIN_LONGITUDE = 'min_longitude';
    const MAX_LONGITUDE = 'max_longitude';
    const MIN_LATITUDE = 'min_latitude';
    const MAX_LATITUDE = 'max_latitude';
    const CACHE_TYPE = 'file';

    public function __construct()
    {
        $this->middleware('map_options');
        $this->middleware('coords');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPlaces(Request $request)
    {
        $data = $request->all();

        $areaFactory = new AreaFactory();
        
        /**
         * @var Area area
         */
        $area = $areaFactory->createArea(
            'Area', 
            $data['zoom'], 
            $data[self::MIN_LATITUDE], 
            $data[self::MAX_LATITUDE],
            $data[self::MIN_LONGITUDE],
            $data[self::MAX_LONGITUDE]
        );

        // create key for cache
        $key = $this->createKey(
            $area->getMaxLatitude(),
            $area->getMinLatitude(),
            $area->getMaxLongitude(),
            $area->getMinLongitude()
        );

        // checking cache
        if (!($values = Cache::store(self::CACHE_TYPE)->get($key))) {
            $places = \App\Place::where('longitude', '>=', $area->getMinLongitude())
                ->where('longitude', '<=', $area->getMaxLongitude())
                ->where('latitude', '>=', $area->getMinLatitude())
                ->where('latitude', '<=', $area->getMaxLatitude())->get();

            $values = $this->preparePlaces($places);
            Cache::store(self::CACHE_TYPE)->put($key, $values, 100);
        }

        return response()->json([
            'error' => REQUEST_SUCCESS,
            'type' => 'FeatureCollection',
            'features' => $values,
        ]);
    }

    /**
     * preparing data for necesserily format
     * @param $places
     * @return array
     */
    private function preparePlaces($places)
    {
        $result = [];
        $i = 0;
        foreach ($places as $place) {
            $result[$i]['type'] = 'Feature';
            $result[$i]['id'] = $place->id;
            $result[$i]['geometry'] = [
                'type' => 'Point',
                'coordinates' => [
                    $place->latitude,
                    $place->longitude
                ]
            ];
            $result[$i]['properties'] = [
                "balloonContent" => $place->name,
                "clusterCaption" => $place->description,
                "hintContent" => $place->address
            ];
            $i++;
        }
        return $result;
    }

    /**
     * create cahce key
     * @param $maxLtd
     * @param $minLtd
     * @param $maxLng
     * @param $minLng
     * @return string
     */
    private function createKey($maxLtd, $minLtd, $maxLng, $minLng) 
    {
        return (string) $maxLtd . (string) $minLtd . (string) $maxLng . (string) $minLng;
    }

}
