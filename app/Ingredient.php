<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        "name",
        "conservation_ID",
    ];

    public function diet()
    {
        return $this->belongsToMany('App\Diet', 'diet_ingredient')->withPivot('diet_ID');
    }

    public function intollerance()
    {
        return $this->belongsToMany('App\Intollerance', 'ingredient_intollerance')->withPivot('intollerance_ID');
    }

    public function conservation()
    {
        return $this->belongsTo('App\Conservation');
    }

    public function dish()
    {
        return $this->belongsToMany('App\Dish', 'ingredient_dish')->withPivot('dish_ID');
    }
}
