<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OsmapController;


Route::get('/', [OsmapController::class, 'index']);
Route::get('/{type}/{id}', [OsmapController::class, 'show'])->name('osmaps.show')->scopeBindings();
