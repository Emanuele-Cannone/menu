<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    protected $fillable = [
        "name"
    ];

    public function dish()
    {
        return $this->belongsToMany('App\Dish', 'diet_dish');
    }
}
