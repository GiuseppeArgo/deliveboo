<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Support\Facades\Auth;


class StatsController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', Carbon::now()->year);
        $month = $request->get('month', Carbon::now()->month);

        $restaurantId = Auth::id();
        $dishesForRestaurant = Dish::where('restaurant_id', $restaurantId)->pluck('id');
        
        // Find orders that include those dishes
        $orders = Order::whereHas('dishes', function ($query) use ($dishesForRestaurant) {
            $query->whereIn('dish_id', $dishesForRestaurant);
        })->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('d'); // Gruppo per giorno della settimana
            });
        
        
        // Calculate the total_price for each day
        $totalPrices = [];
        foreach (range(1, Carbon::create($year, $month)->daysInMonth) as $day) {
            $totalPrices[$day] = $orders->get(sprintf('%02d', $day), collect())->sum('total_price');
        }

        // Calculate the total number of orders and total earnings for the selected month
        $totalOrders = $orders->flatten()->count();
        $totalEarnings = array_sum($totalPrices);

        // Preparare i dati per il grafico
        $data = [];
        foreach (range(1, Carbon::create($year, $month)->daysInMonth) as $day) {
            $data[$day] = $orders->get(sprintf('%02d', $day), collect())->count();
        }

        return view('admin.stats.index', compact('data', 'year', 'month', 'totalPrices', 'totalOrders', 'totalEarnings'));
    }
}
