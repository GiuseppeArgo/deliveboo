<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * shows all the restaurateur's orders
     */
    public function index(Request $request)
    {
        $restaurantId = Auth::id();
        $dishesForRestaurant = Dish::where('restaurant_id', $restaurantId)->pluck('id');
        // Find orders that include those dishes
        $orders = Order::whereHas('dishes', function ($query) use ($dishesForRestaurant) {
            $query->whereIn('dish_id', $dishesForRestaurant);
        })->orderBy('created_at', 'desc')->paginate(10);
        foreach ($orders as $curOrder){
            $curOrder['date'] = Carbon::parse($curOrder['created_at'])->format('d-m-Y H:i');
            // dd($curOrder['date']);

        }

        return view("admin.orders.index", compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurantId = Auth::id();
        $dishesForRestaurant = Dish::where('restaurant_id', $restaurantId)->pluck('id');
        // Find orders that include those dishes
        $orders = Order::whereHas('dishes', function ($query) use ($dishesForRestaurant) {
            $query->whereIn('dish_id', $dishesForRestaurant);
        })->get();

        return view("admin.orders.index", compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $restaurantId = Auth::id();
        $dishesForRestaurant = Dish::where('restaurant_id', $restaurantId)->pluck('id');
        // Find orders that include those dishes
        $orders = Order::whereHas('dishes', function ($query) use ($dishesForRestaurant) {
            $query->whereIn('dish_id', $dishesForRestaurant);
        })->get();

        return view("admin.orders.index", compact('orders'));
    }

    public function show(string $id)
    {
        $data = Auth::id();
        // find order details by id
        $order = Order::with('dishes')->findOrFail($id);
        // if the user_id does not match the restaurant id it takes you back to the index
        if($data != $order->dishes[0]->restaurant_id){

            $restaurantId = Auth::id();
            $dishesForRestaurant = Dish::where('restaurant_id', $restaurantId)->pluck('id');
            // Find orders that include those dishes
            $orders = Order::whereHas('dishes', function ($query) use ($dishesForRestaurant) {
                $query->whereIn('dish_id', $dishesForRestaurant);
            })->get();
            return view("admin.orders.index", compact('orders'))->with('error','Puoi accedere solo ai tuoi ordini!');
        } else {
            $orders = [
                'restaurant_id' => $order->dishes[0]->restaurant_id,
                'dishes' => $order->dishes
            ];
            return view('admin.orders.show', compact('orders'));
        }
    }

    // is index method...
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $restaurantId = Auth::id();
        $dish_id = Dish::where('restaurant_id', $restaurantId)->pluck('id');
        // Find orders that include those dishes
        $orders = Order::whereHas('dishes', function ($query) use ($dish_id) {
            $query->whereIn('dish_id', $dish_id);
        })->get();

        return view("admin.orders.index", compact('orders'));
    }
    //id index method

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
