<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{

    protected $fillable = [
        "name",
        "description",
        "price",
        "major_price",
        "type_ID",
        "video",
    ];


    public function ingredient()
    {
        return $this->belongsToMany('App\Ingredient', 'ingredient_dish')->withPivot('ingredient_ID');
    }

    public function type()
    {
        return $this->hasOne('App\Type');
    }
}
