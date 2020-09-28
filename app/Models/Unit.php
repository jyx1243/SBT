<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';
    public $timestamps = false;

    public function prices()
    {
        return $this->hasMany('App\Models\Price');
    }
}
