<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OsmapController;


Route::get('/', [OsmapController::class, 'index']);
// Route::get('/osmaps', [OsmapController::class, 'show']);
Route::get('/{type}/{id}', [OsmapController::class, 'show'])->name('osmaps.show')->scopeBindings();
Route::get('/osmaps/{id}', [OsmapController::class, 'single'])->name('osmaps.single');

// Route::get('/{osmap:type}/{osmap:id}', function($type, $id) {
//     $url = 'https://www.openstreetmap.org/api/0.6/'.$type.'/'.$id.'.json';
//     return view('osmaps.mapniks');
// })->name('osmaps.mapniks')->scopeBindings();
