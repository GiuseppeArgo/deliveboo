<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\DishOrder;



class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = config ('dborder');
        foreach($orders as $order) {
            $newOrder = new Order();
            $newOrder->name = $order['name'];
            $newOrder->lastname = $order['lastname'];
            $newOrder->phone_number = $order['phone_number'];
            $newOrder->email = $order['email'];
            $newOrder->address = $order['address'];
            $newOrder->data = $order['data'];
            $newOrder->total_price = $order['total_price'];
            $newOrder->status = $order['status'];
            $newOrder->save();

            for ($i = 0; $i < rand(1, 3); $i++) {
                $dishOrder = new \App\Models\DishOrder(); // Assumendo che il modello si chiami così

                // Genera `dish_id` casuale (da 1 a 50), `order_id` che sarà l'ID dell'ordine appena creato e `quantity` casuale (da 1 a 3)
                $dishOrder->dish_id = rand(1, 50);
                $dishOrder->order_id = $newOrder->id;
                $dishOrder->quantity = rand(1, 3);

                $dishOrder->save();
            }
        }
    }
}
