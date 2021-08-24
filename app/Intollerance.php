<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intollerance extends Model
{
    public function ingredient()
    {
        return $this->hasMany('App\Ingredient');
    }
}
