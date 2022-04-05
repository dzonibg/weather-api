<?php

namespace App\Services;

use App\Repositories\WeatherDataRepository;
use App\Repositories\ViewLoggerRepository;

class ShowDataService {

    public WeatherDataRepository $repository;
    public ViewLoggerRepository $loggerRepository;

    public function __construct()
    {
        $this->repository = new WeatherDataRepository();
        $this->loggerRepository = new ViewLoggerRepository();
    }

    public function showCurrentDataByCity(int $city_id)
    {
        $data = $this->repository->getCurrentDataByCityId($city_id);
        $this->loggerRepository->logPageView();
        return $data;
    }

}
