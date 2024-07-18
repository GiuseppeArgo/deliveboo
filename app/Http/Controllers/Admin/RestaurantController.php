<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Restaurant;
use App\Models\Type;
use App\Models\Dish;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Http\Requests\StoreRestaurantRequest;




class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        // Preparazione della query per ottenere i ristoranti
        $query = Restaurant::with('types');

        // Applica la condizione basata sull'ID utente
        if(Auth::user()->id != 1){
            $query->where('user_id', $user_id);
        }

        // Esegui la query e ottieni i risultati
        $restaurant = $query->get();

        // Passa la lista alla vista index

        if ($restaurant->isEmpty()) {
            $restaurant = collect([]);
        }
        // dd($restaurant);
        return view('admin.restaurants.index', compact('restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // fare controllo se l'utente ha gia un ristorante e riportarlo all index.
        $listTypes = Type::all();
        return view("admin.restaurants.create", compact("listTypes"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['city'] = 'Milano';
        $data['image'] = Storage::put('img', $data['image']);
        $data['slug'] = Str::slug($data['name'] . '-' . $data['user_id']);
        $newRestaurant = new Restaurant();
        $newRestaurant->Fill($data);
        $newRestaurant->save();
        $newRestaurant->types()->sync($request->tipologies);

        return redirect()->route("admin.restaurants.index", ["restaurant" => $newRestaurant->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {

        // fare easyloading della lista dei piatti
        return view("admin.restaurants.show", compact("restaurant"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        $data=Auth::id();
        $restaurant = Restaurant::where('user_id',$data)->firstOrFail();
        if($restaurant->user_id !== Auth::id()){
            abort(403);
         }
        $listTypes = Type::all();
        return view('admin.restaurants.edit', compact('restaurant', 'listTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {

            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $data['slug'] = Str::slug($data['name'] . '-' . $data['user_id']);
            if (isset($data['image'])) {
                if ($restaurant->image) {
                    Storage::delete($restaurant->image);
                }
                $data['image'] = Storage::put('img', $data['image']);
            }
            $restaurant->update($data);
            $restaurant->types()->sync($request->tipologies);
            $restaurant->load('types');

            $user_id = Auth::id();
            if(Auth::user()->id != 1){
                $restaurant = Restaurant::with('types')->where('user_id',$user_id)->get();
            } else{
                $restaurant = Restaurant::with('types')->get();
            }
            // dd($restaurant);
            return view('admin.restaurants.index', compact('restaurant'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
