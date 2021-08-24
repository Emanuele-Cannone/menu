<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    public function ingredient()
    {
        return $this->hasMany('App\Ingredient');
    }

    public function type()
    {
        return $this->hasOne('App\Type');
    }
}
