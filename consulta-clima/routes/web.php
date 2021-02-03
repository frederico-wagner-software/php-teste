<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TemperatureController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('index');
});

Route::get('/cold', function (Request $request) {
    $control = new \App\Http\Controllers\TemperatureController();
    return $control->getColdTemperatures();
});

Route::get('/hot', function (Request $request) {
    $control = new \App\Http\Controllers\TemperatureController();
    return $control->getHotTemperatures();
});

Route::get('/nextSevenTemps', function (Request $request) {
    $cityName = $request->input('cityName');
    $control = new \App\Http\Controllers\TemperatureController();
    return $control->getNextSevenTemperatures($cityName);
});