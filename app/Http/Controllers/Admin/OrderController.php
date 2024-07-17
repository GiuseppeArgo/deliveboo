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
    
    public function show(string $id)
{
    $data = Auth::id();
    $order = Order::with('dishes')->find($id); // Trova l'ordine specificato
    $orders = [
        'restaurant_id' => $order->dishes[0]->restaurant_id, // Ottieni il restaurant_id del primo piatto
        'dishes' => $order->dishes // Salva tutta la collezione di piatti
    ];
    return view('admin.orders.show', compact('orders')); // Passa i dati all'view
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
