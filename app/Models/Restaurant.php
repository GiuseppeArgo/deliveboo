<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Support\Str;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name','city','address','image','description','p_iva','slug'];

    //relations
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function types() {
        return $this->belongsToMany(Type::class);
    }

    public function dishes() {
        return $this->hasMany(Dish::class);
    }

        //Mutators
        // public function setNameAttribute($name)
        // {
        //     $this->attributes['name'] = $name;
        //     $this->attributes['slug'] = Str::slug($name. '-' . $this->user_id);
        // }
}
