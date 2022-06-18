<?php

namespace App\Http\Controllers;

use App\Repositories\CityRepository;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(CityRepository $cityRepository) {
        $data = $cityRepository->index();
        return response()->json(['data' => $data], 200);
    }

    public function create(CityRepository $cityRepository) {
        $data = request();
        try {

            $data = $this->validate($data, [
                'name' => 'string|required',
                'country_id' => 'int'
            ]);

            $response = $cityRepository->create($data);

            return response()->json(['data' => $response], 201);

        } catch (\RuntimeException $exception) {
            return response()->json(['data' => $exception->getMessage()]);
        }
    }
}
