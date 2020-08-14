<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    public function option()
    {
        return $this->hasMany('Option');
    }

    public function category()
    {
        return $this->belongsTo('Category');
    }
}
