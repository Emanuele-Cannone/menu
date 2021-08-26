<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{

    protected $fillable = [
        "name",
        "type_id",
        "intollerance_id",
        "diet_id",
        "description",
        // "available",
        "price",
        // "take_away",
        "conservation",
        "images",
        "video",
    ];


    public function intollerance()
    {
        return $this->belongsToMany('App\Intollerance', 'dish_intollerance')->withPivot('intollerance_id');
    }

    public function type()
    {
        return $this->hasOne('App\Type');
    }

    public function diet()
    {
        return $this->belongsToMany('App\Diet', 'diet_dish')->withPivot('diet_id');
    }
}
