<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        //if request type is not null
        if ($request->type) {
            //remove all characters except numbers and turns it into numeric array
            $typesArray = $request->type;
            $typesArray = preg_replace('/[\[\]\s]/', '', $typesArray);
            $typesArray = json_decode('[' . $typesArray . ']');

            //create the query by looping typesArray
            $query = Restaurant::with('types')
                ->where(function ($query) use ($typesArray) {
                    foreach ($typesArray as $typeId) {
                        $query->whereHas('types', function ($q) use ($typeId) {
                            $q->where('id', $typeId);
                        });
                    }
                });

        //normal query with all restaurants
        } else {
            $query = Restaurant::with('types');
        }

        $query = $query->get();

        $data = [
            'result' => $query
        ];

        return response()->json($data);
    }

    public function show(string $slug) {
        
        $showRestaurant = Restaurant::with(['types','dishes'])->where('slug', $slug)->first();
        $data = [
            'result' => $showRestaurant,
        ];

        return response()->json($data);
    }
}
