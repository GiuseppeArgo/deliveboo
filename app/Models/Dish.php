<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Support\Str;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = ['restaurant_id','description','image','price','visibility'];

    // relations
    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }

    //Mutators
    public function setNameAttribute($name)
    {
        $this->attributes['slug'] = Str::slug($name. '-' . $this->restaurant_id);
        $this->attributes['name'] = $name;
    }
}
