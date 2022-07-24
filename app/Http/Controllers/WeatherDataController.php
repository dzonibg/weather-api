<?php

namespace App\Http\Controllers;

use App\Repositories\ViewLoggerRepository;
use App\Services\ShowDataService;
use Illuminate\Http\Request;

class WeatherDataController extends Controller
{
    public function getCurrentCityStats(ShowDataService $service)
    {
        $request = request()->all();
        $city_id = $request['city_id'];
        $data = $service->showCurrentDataByCity($city_id);
        return response()->json(['data' => $data]);
    }

    public function hourlyAveragesLastDay(ShowDataService $service) {
        $request = request()->all();
        $city_id = $request['city_id'];
        return $service->getLastDayAveragesPerHour($city_id);
    }
}
