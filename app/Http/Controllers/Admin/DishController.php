<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDishRequest;
use App\Http\Requests\StoreDishRequest;
use Illuminate\Http\Request;
use App\Models\Dish;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id();
        $dishesList = Dish::where('restaurant_id',$id)->get();
        return view("admin.dishes.index", compact("dishesList"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.dishes.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request, Dish $dish)
    {
        // Non abbiamo gestito unicita del piatto

        $data = $request->validated();
        
        $name=Dish::where('name',$data['name'])->firstOrFail();
        // valore inserito manualmente ma che dobbiamo gestire prelevandolo dallo show dei ristoranti e portantolo nel form della creazione.
        $data['restaurant_id'] = $request->restaurant_id;
        $data['visibility'] = 1;
        $data['image'] = Storage::put('img', $data['image']);
        $newDish = new Dish();
        $newDish->fill($data); 
        if ($data['name'] != $name->name) {
            $newDish->name = $data['name'];  
            $newDish['slug'] = Str::slug($data['name'] . '-' . $data['restaurant_id']);
        }
      
        $newDish->save();

        return redirect()->route("admin.dishes.show", ["dish" => $newDish->slug]);

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
        return view("admin.dishes.edit", compact("dish"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        $data = $request->validated();
        $data['restaurant_id'] = Auth::id();
        $data['slug'] = Str::slug($data['name'] . '-' . $data['restaurant_id']);

        if (isset($data['image'])) {
            if ($dish->image) {
                Storage::delete($dish->image);
            }
            $data['image'] = Storage::put('img', $data['image']);
        }

        $dish->update($data);
        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {

    }

    public function toggle(Request $request, string $id)
    {
        $dish = Dish::findOrFail($id);
        $dish->visibility = $request->visibility;
        $dish->save();
        return redirect()->route('admin.dishes.index');
    }
}
