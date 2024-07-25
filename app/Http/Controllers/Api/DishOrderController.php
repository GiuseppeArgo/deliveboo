<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DishOrder;
use Illuminate\Support\Facades\Log;

class DishOrderController extends Controller
{
    //  chiama dish order che avviene dopo che la chiamata orders va a buon fine.
    public function store(Request $request){
        $data = $request->all();
        Log::info('Dati ricevuti:', $data['dishes']['items']);
        foreach( $data['dishes']['items'] as $curDish){

            $newDishOrder = new DishOrder();
            $newDishOrder->dish_id = $curDish['dish_id'];
            $newDishOrder->quantity = $curDish['quantity'];
            $newDishOrder->order_id = $data['order_id'];
            $newDishOrder->save();
        }



        $data = [
            'result' => 'success'
        ];
        return response()->json($data);
    }

}
