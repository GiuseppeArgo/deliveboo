<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDishRequest;
use App\Http\Requests\StoreDishRequest;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Restaurant;
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
        $id = Auth::id();
        $query = Restaurant::where('user_id', $id)->firstOrFail();
        $restaurant_id = $query->id;
        return view("admin.dishes.create",compact('restaurant_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request, Dish $dish)
    {
        $data = $request->validated();
        $id = $data['restaurant_id'];
        $name= Dish::where('name',$data['name'])->where('restaurant_id', $id)->get();

        $data['restaurant_id'] = $request->restaurant_id;
        $data['visibility'] = 1;
        $data['image'] = Storage::put('img', $data['image']);
        $newDish = new Dish();
        $newDish->fill($data);
        $newDish->name = $data['name'];
        $newDish['slug'] = Str::slug($data['name'] . '-' . $data['restaurant_id']);

        // corrispondenza nome del piatto esistente lo riportiamo indietro
        if (!$name->isEmpty()) {
            return redirect()->route('admin.dishes.create')->with('error', 'Nel tuo menu hai già un piatto con quel nome.')->withInput();
        }

        $newDish->save();

        return redirect()->route("admin.dishes.show", ["dish" => $newDish->slug])->with('message', 'Nel tuo menu hai già un piatto con quel nome.');

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
