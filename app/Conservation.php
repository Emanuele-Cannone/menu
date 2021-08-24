<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conservation extends Model
{
    public function ingredient()
    {
        return $this->hasMany('App\Ingredient');
    }
}
