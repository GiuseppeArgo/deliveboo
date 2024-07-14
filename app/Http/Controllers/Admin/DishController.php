<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dish;
use Illuminate\Support\Facades\Auth;


class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id();
        $listDishes = Dish::where('restaurant_id',$id)->get();
        return view("admin.dishes.index", compact("listDishes"));
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
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {

    }

    public function toggle(Request $request, string $id)
    {
        // dd($id);
        $dish = Dish::findOrFail($id);
        $dish->visibility = $request->visibility;
        $dish->save();
        return redirect()->route('admin.dishes.index');
    }
}
