<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreRestaurantRequest;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.restaurants.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        $listTypes = Type::all();
        return view("admin.restaurants.create", compact("listTypes"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {   
        $data = $request->validated();
        $newRestaurant = new Restaurant();

        $data['image'] = Storage::put('img', $data['image']);
        $newRestaurant->fill($data);
        $newRestaurant->user_id = Auth::id();
        $newRestaurant->city = 'Milano';
        $newRestaurant->name = $data['name'];
        $newRestaurant->save();

        // $newRestaurant->name_restaurant = $data['name_restaurant'];
        // $newRestaurant->city = 'Milano';
        // $newRestaurant->address = $data['address'];
        // $newRestaurant->cover_image = $data['cover_image'];
        // $newRestaurant->description = $data['description'];
        // $newRestaurant->p_iva = $data['p_iva'];
        // $newRestaurant->user_id = $data['user_id'];
        // $newRestaurant->slug = Str::slug($newRestaurant->name . '-' . $newRestaurant->id);
        // $request->validate([
        //     'name_restaurant' => ['required', 'min:3'],
        //     'address' => ['required', 'min:5'],
        //     'cover_image' => ['required'],
        //     'description' => ['required', 'min:5', 'max:255'],
        //     'p_iva' => ['required', 'min:11', 'max:11'],
        //     'user_id' => ['required'],
        // ], [
        //     'name_restaurant' => 'Il nome del ristorante non può essere vuoto e deve contenere almeno 3 caratteri',
        //     'address' => "L'indirizzo non può essere vuoto e deve contenere almeno 5 caratteri",
        //     'cover_image' => "E' necessaria un'immagine",
        //     'description' => "La descrizione è necessaria e deve contenere almeno 5 caratteri",
        //     'p_iva' => "La partita iva è necessaria e deve essere lunga 11 caratteri",
        // ]);

        return redirect()->route("admin.restaurants.show", ["restaurant" => $newRestaurant->slug]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        //  controllo utente puoi vedere e modificare solo i tuoi ristoranti

        // if($restaurant->user_id !== Auth::id()){
        //     abort(403);
        //  }
        $listTypes = Type::all();
        return view('admin.restaurants.edit', compact('restaurant','listTypes'));
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
    public function destroy(string $id)
    {
        //
    }
}
