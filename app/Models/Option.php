<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;

class Option extends Model
{
    use EagerLoadPivotTrait;
    
    protected $table = 'option';
    protected $with = ['product', 'defaultPrice', 'defaultLocation'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function defaultPrice()
    {
        return $this->belongsTo('App\Models\Price', 'default_price_id');
    }

    public function defaultLocation()
    {
        return $this->belongsTo('App\Models\Location', 'default_location_id');
    }

    public function locations()
    {
        return $this->hasMany('App\Models\Location');
    }

    public function prices()
    {
        return $this->hasMany('App\Models\Price');
    }

    public function ingredient()
    {
        return $this->hasOne('App\Models\Ingredient');
    }

    public function ingredients()
    {
        return $this->belongsToMany('App\Models\Ingredient', 'ingredient_option')
        ->using('App\Models\IngredientOption')
        ->withPivot(['unit_id', 'quantity']);
    }
}
