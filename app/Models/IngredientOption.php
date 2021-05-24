<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class IngredientOption extends Pivot
{
    protected $table = 'ingredient_option';
    // protected $with = ['unit'];

    // public function ingredient()
    // {
    //     return $this->belongsTo('App\Models\Ingredient');
    // }

    // public function option()
    // {
    //     return $this->belongsTo('App\Models\Option');
    // }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit');
    }
}
