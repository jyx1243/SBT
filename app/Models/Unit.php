<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';

    public function price()
    {
        return $this->hasMany('App\Models\Price');
    }
}
