<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = [
        "name",
        "avaiability",
        "conservation_ID",
    ];

    public function diet()
    {
        return $this->belongsToMany('App\Diet', 'diet_ingredient')->withPivot('diet_ID');
    }



    public function intollerance()
    {
        return $this->belongsToMany('App\Intollerance');
    }

    public function conservation()
    {
        return $this->belongsTo('App\Conservation');
    }

    public function dish()
    {
        return $this->belongsToMany('App\Dish');
    }
}
