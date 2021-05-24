<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $table = 'ingredient';

    public function option()
    {
        return $this->belongsTo('App\Models\Option');
    }

    public function options()
    {
        return $this->belongsToMany('App\Models\Option', 'ingredient_option')
        ->using('App\Models\IngredientOption')
        ->withPivot(['unit_id', 'quantity']);
    }
}
