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
        $osmurl = Http::get('https://www.openstreetmap.org/api/0.6/'.$type.'/'.$id.'.json');
        return $osmurl;
    }
}

