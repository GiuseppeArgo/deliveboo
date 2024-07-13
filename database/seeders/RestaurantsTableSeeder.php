<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use Illuminate\Support\Str;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = config("dbrestaurant");
        foreach($restaurants as $key => $restaurant) {
            $newRestaurant = new Restaurant();
            $newRestaurant->user_id = $restaurant['user_id'];
            $newRestaurant->name_restaurant = $restaurant['name_restaurant'];
            $newRestaurant->city = $restaurant['city'];
            $newRestaurant->address = $restaurant['address'];
            $newRestaurant->cover_image = $restaurant['cover_image'];
            $newRestaurant->description = $restaurant['description'];
            $newRestaurant->p_iva = $restaurant['p_iva'];
            $newRestaurant->slug = Str::slug($restaurant['name_restaurant'].'-'.$newRestaurant->id);
            $newRestaurant->save();

            $newRestaurantType = new RestaurantType();
            $newRestaurantType->restaurant_id = $newRestaurant->id;
            $newRestaurantType->type_id = $key+1;
            $newRestaurantType->save();
        }

    }
}
