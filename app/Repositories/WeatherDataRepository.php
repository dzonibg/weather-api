<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WeatherDataRepository {

    private $table = 'weather_data';

    public function insertWeatherData($serviceID, $cityID, $temperature) {
        $query = DB::table($this->table)->insert([
            'city_id' => $cityID,
            'time' => date('Y-m-d H:i:s'),
            'service_id' => $serviceID,
            'temperature' => $temperature
        ]);

        return $query;

    }

    public function getCurrentDataByCityId($city_id) {
        $data = DB::table('weather_data')
            ->orderBy('time', 'desc')
            ->limit(1)
            ->first(['time', 'city_id', 'service_id', 'created_at', 'temperature']);
        return $data;
    }

}
