<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
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
            $newOrder->total_price = $order['total_price'];

            // Genera una data casuale tra il 1 e il 31 di luglio
            $randomDayOfMonth = rand(1, 31);
            $randomDate = Carbon::create(2024, 7, $randomDayOfMonth)->startOfDay();

            // Imposta le date create_at e updated_at
            $newOrder->created_at = $randomDate;
            $newOrder->updated_at = $randomDate;

            $newOrder->save();
            for ($i = 0; $i < rand(1, 3); $i++) {
                $dishOrder = new \App\Models\DishOrder();

                $dishOrder->dish_id = rand(1, 45);
                $dishOrder->order_id = $newOrder->id;
                $dishOrder->quantity = rand(1, 3);

                $dishOrder->save();
            }
        }
    }
}
