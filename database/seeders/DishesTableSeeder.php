<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use Illuminate\Support\Str;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dishes = config("dbdish");
        foreach($dishes as $dish) {
            $newDish = new Dish();
            $newDish->restaurant_id = $dish['restaurant_id'];
            $newDish->name = $dish['name'];
            $newDish->description = $dish['description'];
            $newDish->image = $dish['image'];
            $newDish->price = $dish['price'];
            $newDish->visibility = $dish['visibility'];
            $newDish->slug = Str::slug($dish['name'] . '-' . strval($newDish->restaurant_id));
            $newDish->save();
        }
    }
}
