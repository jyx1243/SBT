<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
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
        return $this->belongsToMany('App\Models\Ingredient')->withPivot('unit_id', 'quantity');
    }
}
