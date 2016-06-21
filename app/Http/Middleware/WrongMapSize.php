<?php
/**
 * Created by PhpStorm.
 * User: sascha
 * Date: 6/20/2016
 * Time: 2:45 PM
 */

namespace App\Http\Middleware;

use Closure;

class WrongMapSize {

    const MIN_MAP_WIDTH = 200;
    const MIN_MAP_HEIGHT = 250;
    const ALLOWED_ZOOM = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $width = (int) $request->get('map_width');
        $height = (int) $request->get('map_height');
        $zoom = (int) $request->get('zoom');
        $c = !in_array($zoom, self::ALLOWED_ZOOM);
        if (self::MIN_MAP_WIDTH > $width ||
            self::MIN_MAP_HEIGHT > $height ||
            !in_array($zoom, self::ALLOWED_ZOOM)) {
            return response()->json([
                'error' => REQUEST_ERROR,
                'message' => 'Width, height or zoom of the map are incorrect'
            ]);
        }
        return $next($request);
    }
}