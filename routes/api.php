<?php

use App\Http\Controllers\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\FetchService;
use App\Http\Controllers\WeatherDataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', [FetchService::class, 'fetchWeatherInfo']);
Route::get('heartbeat', function () {
    dispatch(new \App\Jobs\KeepAliveLogJob());
    return "Keep alive!";
});

Route::get('belgrade-temp', [FetchService::class, 'getBelgradeTemperature']);
Route::get('current-temperature', [WeatherDataController::class, 'getCurrentCityStats']);

Route::group(['prefix' => 'cities'], function () {
    Route::get('index', [CityController::class, 'index']);
    Route::post('create', [CityController::class, 'create']);
    Route::get('show', [CityController::class, 'show']);
});
