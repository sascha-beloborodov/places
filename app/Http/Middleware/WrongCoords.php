<?php
/**
 * Created by PhpStorm.
 * User: sascha
 * Date: 6/20/2016
 * Time: 2:45 PM
 */

namespace App\Http\Middleware;

use App\Entities\Map;
use Closure;

class WrongCoords {
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $minLng = (float) $request->get('min_longitude');
        $maxLng = (float) $request->get('max_longitude');
        $minLtd = (float) $request->get('min_latitude');
        $maxLtd = (float) $request->get('max_latitude');
        $map = new Map();
        if ((bool) $minLng && (bool) $maxLng && 
            (bool) $minLtd && (bool) $maxLtd && 
            !$map->checkCoords($minLng, $maxLng, $minLtd, $maxLtd)) {
            return response()->json([
                'error' => REQUEST_ERROR,
                'message' => 'Coords are incorrect'
            ]);
        }
        return $next($request);
    }
}