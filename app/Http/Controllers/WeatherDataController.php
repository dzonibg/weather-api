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
        $repo = new ViewLoggerRepository();
        $repo->logPageView();
        return response()->json(['data' => $data]);
    }
}
