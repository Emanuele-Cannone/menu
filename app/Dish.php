<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{

    protected $fillable = [
        "name",
        "description",
        "avaiability",
        "promo",
        "price",
        "major_price",
        "take_away",
        "type_ID",
    ];


    public function ingredient()
    {
        return $this->hasMany('App\Ingredient', 'ingredient_dish');
    }

    public function type()
    {
        return $this->hasOne('App\Type');
    }
}
