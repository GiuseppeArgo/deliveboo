<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;



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
        }
    }
}
