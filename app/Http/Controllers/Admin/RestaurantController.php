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
use Illuminate\Support\Facades\Log;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the authenticated user ID
        $user_id = Auth::id();

        // all restaurant with types
        $query = Restaurant::with('types');

        // if you don't admin show only your restaurant
        if(Auth::user()->id != 1){
            $query->where('user_id', $user_id);
        }

        $restaurant = $query->get();

        // if you don't have restaurants create an empty collection
        if ($restaurant->isEmpty()) {
            $restaurant = collect([]);
        }
        // I check the existence of the restaurant for the buttons in the dashboard
        $userHasRestaurant = Restaurant::where('user_id', $user_id)->exists();

        return view('admin.restaurants.index', compact('restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get the authenticated user ID
        $userId = Auth::id();

        // Check if the user already has a restaurant
        $existingRestaurant = Restaurant::where('user_id', $userId)->first();

        // If the user already has a restaurant, redirect them to the index page with a message
        if ($existingRestaurant) {
        return redirect()->route('admin.restaurants.index')->with('error', 'Hai già un ristorante registrato.');
        }

        $listTypes = Type::all();
        return view("admin.restaurants.create", compact("listTypes"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        // Validate the request data through the StoreRestaurantRequest form request
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        //  qesto dovrebbe inserire l'id al ristorante una volta eliminato l'auto increment ad id.
        // $data['id'] = Auth::id();

        $data['city'] = 'Milano';

        // Save the uploaded image to storage and get the path of the new image
        $data['image'] = Storage::put('img', $data['image']);

        // Create a unique slug based on the restaurant name and user ID
        $data['slug'] = Str::slug($data['name'] . '-' . $data['user_id']);

        $newRestaurant = new Restaurant();
        $newRestaurant->Fill($data);
        $newRestaurant->save();

        // Sync the selected type_id with the Restaurant model
        $newRestaurant->types()->sync($request->tipologies);

        return redirect()->route("admin.restaurants.index", ["restaurant" => $newRestaurant->slug]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        $data=Auth::id();

        // search in database the restaurant
        $restaurant = Restaurant::where('user_id',$data)->firstOrFail();

        // if the user's ID is different from that of the restaurant
        if($restaurant->user_id !== Auth::id()){
            abort(403);
         }
        //else show edit page
        $listTypes = Type::all();
        return view('admin.restaurants.edit', compact('restaurant', 'listTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
            // validate request
            $data = $request->validated();

            //add user_id and to restaurant
            // credo che non serve assegnarlo ad una modifica perche lo ha gia
            $data['user_id'] = Auth::id();

            //update slug
            $data['slug'] = Str::slug($data['name'] . '-' . $data['user_id']);

            //control image to delete old image and add new.
            if (isset($data['image'])) {
                if ($restaurant->image) {
                    Storage::delete($restaurant->image);
                }
                $data['image'] = Storage::put('img', $data['image']);
            }

            //update restaurant
            $restaurant->update($data);

            //sinc typologies in pivot table
            $restaurant->types()->sync($request->tipologies);

            // at restaurant add types records. (eager loading)
            $restaurant->load('types');


            $user_id = Auth::id();

            // if the id doesn't match one it only shows the user's restaurant otherwise you are the admin and show them all
            if(Auth::user()->id != 1){
                $restaurant = Restaurant::with('types')->where('user_id',$user_id)->get();
            } else{
                $restaurant = Restaurant::with('types')->get();
            }
            return redirect()->route('admin.restaurants.index')->with('message', 'Ristorante aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
