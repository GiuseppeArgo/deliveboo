<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\UpdateRestaurantRequest;
use App\Http\Requests\Admin\StoreRestaurantRequest;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Restaurant;
use App\Models\Dish;

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
        $data['user_id'] = Auth::id();
        $data['city'] = 'Milano';
        $data['image'] = Storage::put('img', $data['image']);
        $data['slug'] = Str::slug($data['name']. '-' . $data['user_id']);
        $newRestaurant = new Restaurant();
        $newRestaurant->Fill($data);
        $newRestaurant->save();

        return redirect()->route("admin.restaurants.show", ["restaurant" => $newRestaurant->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        return view("admin.restaurants.show", compact("restaurant"));
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
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['name']. '-' . $data['user_id']);
        // dd($data);
        $newRestaurant = new Restaurant();
        if (isset($data['image'])) {
            if ($restaurant->image) {
                Storage::delete($restaurant->image);
            }
            $data['image'] = Storage::put('img', $data['image']);
        }
        // remove image without add other
        if($request['removeImage'] != NULL && $restaurant->image != NULL){
            Storage::delete($restaurant->image);
            $restaurant->image = NULL;
        }
        // /remove image without add other

        $restaurant->update($data);
        $restaurant->types()->sync($request->tipologies);
        return view('admin.restaurants.show', compact('restaurant'));
    }



    //     return redirect()->route("admin.restaurants.show", ["restaurant" => $newRestaurant->slug]);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
