<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDishRequest;
use App\Http\Requests\StoreDishRequest;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */             //Request $request
    public function index()
    {
        //search all dishes of restaurant
        $restaurant_id = Auth::id();
        $dishesList = Dish::where('restaurant_id',$restaurant_id)->get();
        return view("admin.dishes.index", compact("dishesList",'restaurant_id'));
    }

    /**
     * Show the form for creating a new resource.
     */                 //Request $request
    public function create()
    {
        $restaurant_id = Auth::id();

        return view("admin.dishes.create",compact('restaurant_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request, Dish $dish)
    {
        // save validated request
        $data = $request->validated();

        // save id
        $data['restaurant_id'] = Auth::id();

        // look for the name in the list of restaurant dishes
        $name= Dish::where('name',$data['name'])->where('restaurant_id', $data['restaurant_id'])->get();

        // if it has found a match we return to create with an error message
        if (!$name->isEmpty()) {
            return redirect()->route('admin.dishes.create')->with('error', 'Nel tuo menu hai già un piatto con quel nome.')->withInput();
        } else{
            // standardizes the price with 2 decimal places
            $data['price'] = number_format($data['price'], 2, '.', '');

            $data['visibility'] = 1;
            $data['image'] = Storage::put('img', $data['image']);
            $newDish = new Dish();
            $newDish->fill($data);
            $newDish->name = ucwords(strtolower($data['name']));
            $newDish['slug'] = Str::slug($data['name'] . '-' . $data['restaurant_id']);

            $newDish->save();

            return redirect()->route("admin.dishes.show", ["dish" => $newDish->slug])->with('message', 'Piatto inserito correttamente');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {

        return view("admin.dishes.show", compact("dish"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        $id = Auth::id();
        $query = Restaurant::where('user_id', $id)->firstOrFail();
        $restaurant_id = $query->id;
        return view("admin.dishes.edit", compact("dish","restaurant_id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        $data = $request->validated();
        $id = Auth::id();
        $name = Dish::where('restaurant_id', $id)->where('name',$data['name'])->first();

        // if there is no match, update the record
        if (!$name || $name->name == $data['oldname']) {
            $data['restaurant_id'] = $request->restaurant_id;
            $data['slug'] = Str::slug($data['name'] . '-' . $data['restaurant_id']);
            // if a new image arrives I will replace it
            if (isset($data['image'])) {
                if ($dish->image) {
                    Storage::delete($dish->image);
                }
                $data['image'] = Storage::put('img', $data['image']);
            }
            // standardizes the price with 2 decimal places
            $data['price'] = number_format($data['price'], 2, '.', '');

            $dish->update($data);

            return redirect()->route('admin.dishes.show', ['dish' => $dish->slug])->with('message', 'Le tue modifiche sono state apportate correttamente');
        } else{

            return redirect()->route('admin.dishes.edit',compact('dish'))->with('error', 'Nel tuo menu hai già un piatto con quel nome.')->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {

    }

    /**
     * changes the status from true to false
     */
    public function toggle(Request $request, string $id)
    {
        $data = $request->all();
        $restaurant_id = $data['restaurant_id'];
        if($data['visibility'] == 1){
            $data['visibility'] = 0;
        } else {
            $data['visibility'] = 1;
        }
        // dd($data);
        $dish = Dish::findOrFail($id);
        $dish->visibility = $data['visibility'];
        $dish->save();
        return redirect()->route('admin.dishes.index',compact('restaurant_id'));
    }
}
