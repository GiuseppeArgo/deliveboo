<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $restaurantId = Auth::id(); // L'ID del ristorante che stiamo cercando
        $dishesForRestaurant = Dish::where('restaurant_id', $restaurantId)->pluck('id');
        // Passaggio 2: Trova gli ordini che includono quei piatti
        $orders = Order::whereHas('dishes', function ($query) use ($dishesForRestaurant) {
            $query->whereIn('dish_id', $dishesForRestaurant);
        })->get();
        // dd($dishesForRestaurant);

        return view("admin.orders.index", compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orders = Order::with('dishes')->find($id);
        // dd($orders);
        $orders = $orders->dishes;
        return view('admin.orders.show', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

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
