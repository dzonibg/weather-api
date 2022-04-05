<?php

namespace App\Services;

use App\Repositories\WeatherDataRepository;
use App\Repositories\ViewLoggerRepository;

class ShowDataService {

    public WeatherDataRepository $repository;

    public function __construct() {
        $this->repository = new WeatherDataRepository;
    }

    public function showCurrentDataByCity($city_id)
    {
        $data = $this->repository->getCurrentDataByCityId($city_id);
        $repo = new ViewLoggerRepository();
        $repo->logPageView();
        return $data;
    }

}
