<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'option';

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function defaultLocation()
    {
        return $this->belongsTo('App\Models\Location', 'default_location_id');
    }

    public function location()
    {
        return $this->hasMany('App\Models\Location');
    }
}
