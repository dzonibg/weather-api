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
            'temperature' => $temperature,
            'created_at' => Carbon::now()
        ]);

        return $query;

    }

    public function getCurrentDataByCityId($city_id)
    {
        $data = DB::table('weather_data')
            ->orderBy('time', 'desc')
            ->where('city_id', $city_id)
            ->limit(1)
            ->first(['time', 'city_id', 'service_id', 'created_at', 'temperature']);
        return $data;
    }

    public function getLastMonthAverage($city_id)
    {
        $query = "
        select distinct(date(time)) as dt, avg(temperature) from weather_data
        where city_id={$city_id}
        group by dt
        order by dt desc";
        return DB::raw($query);
    }

    public function getLastDayAveragePerHour($city_id) {
        $query = "
        with temperature_data as
                         (select city_id, temperature, date_trunc('hour', time), row_number() over (PARTITION BY date_trunc('hour', time)) rn
                          from weather_data
                          where time >= now() - interval '1 DAY'
                          and city_id = {$city_id}
                          group by city_id, temperature, date_trunc('hour', time)
                          order by date_trunc('hour', time) asc)
        select round(avg(temperature)::numeric, 1), date_trunc::time from temperature_data
        group by date_trunc
        ";

        return DB::select(DB::raw($query));
    }

}
