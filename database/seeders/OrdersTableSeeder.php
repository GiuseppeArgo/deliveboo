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
            $randomDate = Carbon::create(2024, 1, $randomDayOfMonth)->startOfDay();

            // Imposta le date create_at e updated_at
            $newOrder->created_at = $randomDate;
            $newOrder->updated_at = $randomDate;

            $newOrder->save();
            $rndNumber = rand(1,9);
            for ($i = 0; $i < rand(1, 3); $i++) {
                $dishOrder = new \App\Models\DishOrder();
                $dishOrder->order_id = $newOrder->id;

                if($rndNumber === 1){
                    $dishOrder->dish_id = rand(1, 5);
                } else if ($rndNumber === 2){
                    $dishOrder->dish_id = rand(6, 10);
                } else if ($rndNumber === 3){
                    $dishOrder->dish_id = rand(11, 15);
                } else if ($rndNumber === 4){
                    $dishOrder->dish_id = rand(16, 20);
                } else if ($rndNumber === 5){
                    $dishOrder->dish_id = rand(21, 25);
                } else if ($rndNumber === 6){
                    $dishOrder->dish_id = rand(26, 30);
                } else if ($rndNumber === 7){
                    $dishOrder->dish_id = rand(31, 35);
                } else if ($rndNumber === 8){
                    $dishOrder->dish_id = rand(36, 40);
                } else if ($rndNumber === 9){
                    $dishOrder->dish_id = rand(40, 45);
                }
                $dishOrder->quantity = rand(1, 3);

                $dishOrder->save();
            }
        }
    }
}
