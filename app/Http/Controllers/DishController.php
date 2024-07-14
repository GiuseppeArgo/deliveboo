<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::all();
        return view('admin.dashboard', compact('dishes'));
    }

    public function update(Request $request, $id)
    {
        $dish = Dish::findOrFail($id);
        $dish->update($request->all());

        return redirect()->route('dishes.show', $dish->id)->with('success', 'Piatto aggiornato con successo!');
    }
}
