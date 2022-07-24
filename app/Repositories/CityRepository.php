<?php

namespace App\Repositories;

use App\Models\City;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CityRepository {

    private string $table = "cities";
    private $model;

    public function __construct() {
        $this->model = new City();
    }

    public function index() {
        return DB::table($this->table)
            ->select()
            ->orderBy('id', 'asc')
            ->get();
    }

    public function create($data) {
        return DB::table($this->table)
            ->insert([
                'name' => $data['name'],
                'country_id' => $data['country_id'],
                'created_at' => Carbon::now()
            ]);
    }

    public function show($cityID) {
        return DB::table($this->table)
            ->select()
            ->where('id', $cityID)
            ->get();
    }
}
