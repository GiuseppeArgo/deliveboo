<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\DishOrder;
use App\Models\Dish;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        $orders = config('dborder');
        foreach ($orders as $order) {
            $newOrder = new Order();
            $newOrder->name = $order['name'];
            $newOrder->lastname = $order['lastname'];
            $newOrder->phone_number = $order['phone_number'];
            $newOrder->email = $order['email'];
            $newOrder->address = $order['address'];
            $newOrder->total_price = 0; // Inizializza il totale a zero

            // Genera una data casuale tra il 1 e il 31 di luglio
            $randomDayOfMonth = rand(1, 30);
            $randomDate = Carbon::create(2024, 6, $randomDayOfMonth)->startOfDay();

            // Imposta le date create_at e updated_at
            $newOrder->created_at = $randomDate;
            $newOrder->updated_at = $randomDate;

            $newOrder->save();

            // Calcola il totale dell'ordine
            $totalPrice = 0;
            for ($i = 0; $i <= 1; $i++) {
                $dishOrder = new DishOrder();
                $dishOrder->order_id = $newOrder->id;
                $dishOrder->dish_id = 6 + $i;
                $dishOrder->quantity = rand(1, 3);
                $dishOrder->save();

                // Recupera il prezzo del piatto dalla tabella Dishes
                $dishPrice = Dish::find($dishOrder->dish_id)->price;

                // Calcola il costo totale del piatto nell'ordine
                $totalPrice += $dishPrice * $dishOrder->quantity;
            }

            // Aggiorna il totale dell'ordine
            $newOrder->total_price = $totalPrice;
            $newOrder->save();
        }
    }
}
