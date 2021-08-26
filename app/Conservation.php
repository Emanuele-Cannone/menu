<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conservation extends Model
{
    public function dish()
    {
        return $this->hasMany('App\Dish');
    }
}
