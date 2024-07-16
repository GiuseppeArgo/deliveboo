<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $restaurants = Restaurant::with('types')->get();

        // se arriva il parametro type filtra per tipo
        if ($request->type) {
            $typeId = $request->type;
            $restaurants = Restaurant::with('types')
                ->whereHas('types', function ($query) use ($typeId) {
                    $query->where('id', $typeId); // Assicurati che il nome della colonna corrisponda a quello della tua tabella di collegamento
                })->get();
            dd($restaurants);
        }

        $data = [
            'result' => $restaurants
        ];
        return response()->json($data);
    }


}
