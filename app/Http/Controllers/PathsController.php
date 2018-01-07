<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PathsController extends Controller
{
    /**
     * Receive the data for sorce and destiny and get the paths
     */
    public function receive(Request $request){

        $sourceLat = $request->get('txtLatitude1');
        $sourceLong = $request->get('txtLongitude1');
        $destinyLat = $request->get('txtLatitude2');
        $destinyLong = $request->get('txtLongitude2');

        $response = \GoogleMaps::load('directions')
            ->setParam ([
                'origin' => $sourceLat . ',' . $sourceLong,
                'destination' => $destinyLat . ',' . $destinyLong,
                'mode' => 'driving',
                'alternatives' => 'true'
            ])
            ->get();

        //get response and define the 3 shortest paths (in time)
        $routes = json_decode($response, true)['routes'];
        $shortests_distances = [];
        $shortests_durations = [];
        foreach ($routes as $key => $route) {
            $distance = $route['legs']['distance']['value'];
            $duration = $route['legs']['duration']['value'];

            if (!empty($shortests_distances) and count($shortests_distances) < 3) {

            }
        }


        return response()->json(['source' => 'Abigail', 'destiny' => 'CA']);
    }
}
