<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Osmap extends Model
{
    use HasFactory;

    // public static function map()
    // {
    //     $query = '[out:json][timeout:400];way["tourism"="guest_house"](8.827402638625081,38.63822937011719,9.104808725563043,38.91632080078125);out%20body;';

    //     $apiUrl = Http::get('https://www.overpass-api.de/api/map?data='.$query)->json()['elements'];

    //     return $apiUrl;
    // }

    public static function osmApiUrl()
    {
      // Get a single OSM_TYPE and OSM_ID for each JSON elements from the OverPassApi Query
      // When user hits /OSM_TYPE/OSM_ID endpoint -> Redirect to the intended URL or Get JSON Data

        $query = '[out:json][timeout:400];way["tourism"="guest_house"](8.827402638625081,38.63822937011719,9.104808725563043,38.91632080078125);out%20body;';
        $osmaps = Http::get('https://www.overpass-api.de/api/map?data='.$query)->json()['elements'];

        $map_length = count($osmaps);

        for ($i=0; $i < $map_length; $i++) {
            foreach ($osmaps as $osmap) {
                $type = $osmap['type'];
                $id = $osmap['id'];
            }
            $osmurl = Http::get('https://www.openstreetmap.org/api/0.6/'.$type.'/'.$id.'.json');
            return $osmurl;
        }
        $returnData = file_get_contents($osmurl, true);
        $finalData = json_encode($returnData);
        return $finalData;
    }
}
