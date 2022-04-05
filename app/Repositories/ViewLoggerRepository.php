<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

class ViewLoggerRepository
{

    public function __construct()
    {

    }

    public function logPageView()
    {
        $endpoint = Request::url();
        $method = Request::method();
        $parameters = Request::all();
        $ip = Request::ip();
        DB::table('view_logs')->insert([
            'ip' => $ip,
            'url' => $endpoint,
            'method' => $method,
            'parameters' => json_encode($parameters)
        ]);
    }

}
