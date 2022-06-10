<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Osmap;

class OsmapController extends Controller
{
    public function index()
    {
        $query = '[out:json][timeout:400];nwr["name"](8.827402638625081,38.63822937011719,9.104808725563043,38.91632080078125);out%20body;';

        $osmaps = collect(Http::get('https://www.overpass-api.de/api/map?data='.$query)->json()['elements']);

        return view('osmaps.index', ['osmaps' => $osmaps]);
    }

    public function show($type, $id)
    {
        $query = '[out:json][timeout:400];way["tourism"="guest_house"](8.827402638625081,38.63822937011719,9.104808725563043,38.91632080078125);out%20body;';

        $osmaps = Http::get('https://www.overpass-api.de/api/map?data='.$query)->json()['elements'];

        $map_length = count($osmaps);

        if ($map_length > 0) {
            foreach ($osmaps as $osmap) {
                $type = $osmap['type'];
                $id = $osmap['id'];
            }
        }
        $osmurl = Http::get('https://www.openstreetmap.org/api/0.6/'.$type.'/'.$id.'.json');
        return $osmurl;
        // return view('osmaps.show', compact($osmap));
    }

    public function single($id)
    {
        // $bbox = '38.61,8.8,38.96,9.13';
        // $xapi = Http::get('http://master.apis.dev.openstreetmap.org/api/0.6/map?bbox=' . $bbox);
        $id = '445313461';
        $data = Http::get('https://openstreetmap.org/api/0.6/node/'.$id.'json');
        dump($data);
    }
}

