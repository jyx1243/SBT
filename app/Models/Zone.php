<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $table = 'zone';
    public $timestamps = false;

    public function locations()
    {
        return $this->hasMany('App\Models\Location');
    }
}
