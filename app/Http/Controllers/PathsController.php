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

        return response()->json(['source' => 'Abigail', 'destiny' => 'CA']);
    }
}
