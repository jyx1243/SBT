<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'option';

    public function location()
    {
        return $this->hasMany('Location');
    }

    public function product()
    {
        return $this->belongsTo('Product');
    }
}
