<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    public function options()
    {
        return $this->hasMany('App\Models\Option');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
