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
        $durations = [];
        foreach ($routes as $key => $route) {
            $duration = $route['legs'][0]['duration']['value'];
            $durations[$key] = $duration;
        }

        // sort array
        asort($durations, SORT_NUMERIC);
        //get 3 smallest values from array
        $smallest_durations = array_slice($durations, 0, 3, true);

        //get the values to return from original routes array
        $origin = [];
        $destination = [];
        $origin['latitude'] = $routes[array_keys($smallest_durations)[0]]['legs'][0]['start_location']['lat'];
        $origin['longitude'] = $routes[array_keys($smallest_durations)[0]]['legs'][0]['start_location']['lng'];
        $origin['address'] = $routes[array_keys($smallest_durations)[0]]['legs'][0]['start_address'];
        $destination['latitude'] = $routes[array_keys($smallest_durations)[0]]['legs'][0]['end_location']['lat'];
        $destination['longitude'] = $routes[array_keys($smallest_durations)[0]]['legs'][0]['end_location']['lng'];
        $destination['address'] = $routes[array_keys($smallest_durations)[0]]['legs'][0]['end_address'];
        $legs = $routes[array_keys($smallest_durations)[0]]['legs'];


        return response()->json(['origin' => $origin, 'destination' => $destination, 'legs' => $legs]);
    }
}
