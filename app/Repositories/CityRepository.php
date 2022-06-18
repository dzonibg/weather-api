<?php

namespace App\Repositories;

use App\Models\City;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CityRepository {

    private string $table = "cities";
    private $model = null;

    public function __construct() {
        $this->model = new City();
    }

    public function index() {
        return DB::table('cities')
            ->select()
            ->orderBy('id', 'asc')
            ->get();
    }

    public function create($data) {
        return DB::table('cities')
            ->insert([
                'name' => $data['name'],
                'country_id' => $data['country_id'],
                'created_at' => Carbon::now()
            ]);
    }

    public function show($cityID) {
        return DB::table('cities')
            ->select()
            ->where('id', $cityID)
            ->get();
    }
}
