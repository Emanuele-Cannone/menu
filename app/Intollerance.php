<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intollerance extends Model
{
    public function dish()
    {
        return $this->hasMany('App\Dish');
    }
}
