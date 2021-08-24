<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    public function ingredient()
    {
        return $this->belongsToMany('App\Ingredient', 'diet_ingredient');
    }
}
