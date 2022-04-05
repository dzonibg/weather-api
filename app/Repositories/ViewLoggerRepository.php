<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

class ViewLoggerRepository
{

    public function logPageView()
    {
        $endpoint = Request::url();
        $method = Request::method();
        $parameters = Request::all();
        $ip = Request::ip();
        dd($endpoint, $ip, $method, $parameters);
    }

}
